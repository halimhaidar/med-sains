<?php

// app/Http/Controllers/CompanyController.php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'company' => 'required|string|max:255',
                'segment' => 'required|string|max:255|in:hospital,industry,education',
            ]);
            $created_by = Auth::user()->fullname;
    
            Log::info("Authorize by: " . $created_by);
    
            $data = $request->all();
            $data['pic'] = $created_by;
            $data['created_by'] = $created_by;
    
            Log::info('Company data:', $data);
    
            Company::create($data);
        } catch (\Throwable $th) {
            log::info('Create Company error with:'. $th);
        }
        

        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully.');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'company' => 'required|string|max:255',
            'segment' => 'required|string|max:255|in:hospital,industri,education',
        ]);

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
