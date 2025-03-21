<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:companies',
            'logo' => 'nullable|image|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|regex:/^(https?:\/\/)?(www\.)?([a-zA-Z0-9\-]+\.[a-zA-Z]{2,})(\/.*)?$/|unique:companies',
        ]);

        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $company->logo = $path;
        }

        $company->save();
        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:companies,email,' . $company->id,
            'logo' => 'nullable|image|dimensions:min_width=100,min_height=100',
            'website' => 'nullable|regex:/^(https?:\/\/)?(www\.)?([a-zA-Z0-9\-]+\.[a-zA-Z]{2,})(\/.*)?$/|unique:companies' . $company->id,
        ]);

        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $path = $request->file('logo')->store('logos', 'public');
            $company->logo = $path;
        }

        $company->save();
        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        // Delete logo if exists
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }
        $company->delete();
        return redirect()->route('companies.index');
    }
}