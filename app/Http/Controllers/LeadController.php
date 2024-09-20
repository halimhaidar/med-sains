<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('med_sains.leads as a')
            ->join('users as b', 'b.id', '=', 'a.assign_to')
            ->select('a.*', 'b.fullname');


        if ($search) {
            $query->where('contact_name', 'like', "%$search%")
                ->where('contact_phone', 'like', "%$search%")
                ->where('contact_company', 'like', "%$search%")
                ->where('contact_company', 'like', "%$search%")
                ->where('source', 'like', "%$search%")
                ->where('status', 'like', "%$search%");
        }

        $leads = $query->paginate(10);


        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $contactsAll = Contact::all();

        $contact_id = $request->input('contact_id');

        $contact = Contact::find($contact_id);

        $user = Auth::user();
        if ($user->role == 'admin') {
            $user = User::all();
        }
        return view('leads.create', compact('contactsAll', 'contact', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        try {

            $request->validate([
                'contact_id' => 'required|string|max:50',
            ]);
            $contact = Contact::findOrFail($request->contact_id);
            $data = $request->all();
            $data['contact_name'] = $contact->name;
            $data['contact_phone'] = $contact->phone;
            $data['contact_company'] = $contact->company;
            $data['contact_email'] = $contact->email;

            Lead::create($data);
        } catch (\Throwable $th) {

            return redirect()->route('leads.index')
                ->with('error', 'An error occurred while creating the lead.');
        }

        return redirect()->route('leads.index')
            ->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        return view('leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead, Request $request)
    {
        $contactsAll = Contact::all();


        if ($request->contact_id) {
            $contact_id = $request->input('contact_id');
        } else {
            $contact_id = $lead->contact_id;
        }

        if ($contact_id) {
            $contact = Contact::find($contact_id);
        }
        $user = Auth::user();
        if ($user->role == 'admin') {
            $user = User::all();
        }
        return view('leads.edit', compact('contactsAll', 'contact', 'lead', 'user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {

        try {
            $request->validate([
                'contact_id' => 'required|string|max:50',
            ]);
            $contact = Contact::findOrFail($request->contact_id);

            $lead->fill($request->all());


            $lead->contact_name = $contact->name;
            $lead->contact_phone = $contact->phone;
            $lead->contact_company = $contact->company;
            $lead->contact_email = $contact->email;

            $lead->save();
        } catch (\Throwable $th) {

            return redirect()->route('leads.index')
                ->with('error', 'An error occurred while creating the lead.');
        }


        return redirect()->route('leads.index')
            ->with('success', 'Lead update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);

        $lead->delete();

        return redirect()->route('leads.index')
            ->with('success', 'Lead deleted successfully.');
    }
}
