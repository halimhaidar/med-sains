<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\ContactAddress;
use App\Models\DataArea;
use App\Models\Salutations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $srcCompany = $request->input('searCompany');

        $query = Contact::query();

        if ($search) {
            $query->where('name', 'like', "%$search%")
                ->orwhere('company', 'like', "%$search%")
                ->orWhere('segment', 'like', "%$search%")
                ->orWhere('pic', 'like', "%$search%");
        }
        $companies = Company::all();
        $contacts = $query->paginate(10);

        //get salutation
        $salutations = Salutations::select('id', 'salutation')->get();

        //search company
        if ($srcCompany) {
            $companies = Company::where('company', 'like', "%$srcCompany%")->get();
        }
        //data area
        $subdistrictCodes = $companies->pluck('subdistrict_code')->unique();
        $areas = DataArea::whereIn('subdistrict_code', $subdistrictCodes)->get()->keyBy('subdistrict_code');

        $companies = $companies->map(function ($company) use ($areas) {
            $company->area = $areas->get($company->subdistrict_code);
            return $company;
        });

        return view('contacts.index', compact('contacts', 'companies', 'salutations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        // dd($companies);
        return view('contacts.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|email|unique:contacts,email',
                'phone' => 'required|max:20',
                'gender' => 'required|string|max:10',
                'company_id' => 'required|string|max:10',
                'segment' => 'required|string|max:50'
            ]);
            $created_by = Auth::user()->fullname;
            $company = Company::findOrFail($request->company_id);
            $data = $request->all();
            $data['company'] = $company->company;
            $data['pic'] = $created_by;
            $data['created_by'] = $created_by;

            $contact_data = Contact::create($data);
            $data_address = null;
            $data_address['contact_id'] = $contact_data->id;
            $data_address['phone'] = $contact_data->phone;
            $data_address['province'] = $contact_data->province;
            $data_address['city'] = $contact_data->city;
            $data_address['post_code'] = $contact_data->post_code;
            $data_address['address'] = $contact_data->address;
            $data_address['default'] = 1;
            $cekaddress = ContactAddress::create($data_address);
        } catch (\Throwable $th) {
            return redirect()->route('contacts.index')
                ->with('error', 'An error occurred while creating the contact.');
        }


        return redirect()->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        $companies = Company::all();
        return view('contacts.edit', compact('contact', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => [
                'required',
                'email',
                Rule::unique('contacts')->ignore($contact->id),
            ],
            'phone' => 'required|max:20',
            'gender' => 'required|string|max:10',
            'company_id' => 'required|string|max:10',
            'segment' => 'required|string|max:50'
        ]);

        $data = $request->all();

        if ($request->company_id != $contact->company_id) {
            $company = Company::findOrFail($request->company_id);
            $data['company'] = $company->company;
        }

        $contact->update($request->all());

        return redirect()->route('contacts.index')
            ->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }
}
