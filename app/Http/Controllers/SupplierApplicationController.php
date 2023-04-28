<?php

namespace App\Http\Controllers;

use App\Models\SupplierApplication;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.frontend_layout.supplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email|max:255',
            'company_number' => 'required|string|max:255',
            'company_country' => 'required|string|max:255',
            'company_street' => 'required|string|max:255',
            'company_city' => 'required|string|max:255',
            'company_state' => 'required|string|max:255',
            'company_zip' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ]);
    
        // Create a new SupplierApplication instance
        $supplierApplication = new SupplierApplication([
            'user_id' => Auth::user()->id,
            'company_name' => $validatedData['company_name'],
            'company_email' => $validatedData['company_email'],
            'company_number' => $validatedData['company_number'],
            'company_country' => $validatedData['company_country'],
            'company_street' => $validatedData['company_street'],
            'company_city' => $validatedData['company_city'],
            'company_state' => $validatedData['company_state'],
            'company_zip' => $validatedData['company_zip'],
            'message' => $validatedData['message'],
        ]);
    
        $supplierApplication->save();
    
        return redirect()->route('supplier.products')->with('success','Informations envoyé.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SupplierApplication $supplierApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierApplication $supplierApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplierApplication $supplierApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierApplication $supplierApplication)
    {
        //
    }
}
