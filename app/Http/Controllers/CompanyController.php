<?php

// app/Http/Controllers/CompanyController.php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $query = Company::query();
    
        if ($search) {
            $query->where('company', 'like', "%$search%")
                  ->orWhere('pic', 'like', "%$search%")
                  ->orWhere('segment', 'like', "%$search%")
                  ->orWhere('division', 'like', "%$search%");
        }
    
        $companies = $query->paginate(10);
    
        return view('companies.index', compact('companies'));
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.show', compact('company'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'segment' => 'required|string|max:255|in:hospital,industry,education',
        ]);
        try {
            $created_by = Auth::user()->fullname;

            Log::info("Authorize by: " . $created_by);

            $data = $request->all();
            $data['pic'] = $created_by;
            $data['created_by'] = $created_by;

            Log::info('Company data:', $data);

            Company::create($data);
            return redirect()->route('companies.index')
                ->with('success', 'Company created successfully.');
        } catch (\Throwable $th) {
            log::info('Create Company error with:' . $th);
            return redirect()->route('companies.index')
            ->with('error', 'An error occurred while creating the company.');
        }
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $users = User::all();
        return view('companies.edit', compact('company', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'company' => 'required|string|max:255',
            'segment' => 'required|string|max:255|in:hospital,industry,education',
        ]);

        $company = Company::findOrFail($id);
        $company->update($request->all());

        return redirect()->route('companies.index')
            ->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }
}
