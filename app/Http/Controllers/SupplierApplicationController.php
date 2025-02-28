<?php

namespace App\Http\Controllers;

use App\Models\SupplierApplication;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierApplicationController extends Controller
{
    /**
     * Afficher la liste des demandes fourniseurs.
     */
    public function index()
    {
        $applications = SupplierApplication::where('statut', NULL)->paginate(5);
        return view('admin.applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new supplier apply.
     */
    public function create()
    {
        return view('frontend.frontend_layout.supplier');
    }

    /**
     * Store a newly created applications.
     */
    public function store(Request $request)
    {
        $stringRule = 'required|string|max:255';

        $validatedData = $request->validate([
            'company_name' => $stringRule,
            'company_email' => 'required|email|max:255',
            'company_number' => $stringRule,
            'company_country' => $stringRule,
            'company_street' => $stringRule,
            'company_city' => $stringRule,
            'company_state' => $stringRule,
            'company_zip' => $stringRule,
            'message' => 'required|string|max:1000',
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

        return redirect()->route('supplier.application')->with('success','Informations envoyé.');
    }

    /**
     * Afficher la page demande fournisseur.
     */
    public function show($id)
    {
        $application = SupplierApplication::find($id);
        return view('admin.applications.info', compact('application'));
    }


    //methode pour accepter la demande
    public function accept($id){
        $application = SupplierApplication::find($id);
        $user = User::find($application->user_id);
        $user->role = 'supplier';
        $user->save();
        $application->statut = 'accept';
        $application->save();
        return redirect()->route('admin.applications')->with('success','Application accepté.');
    }

    //methode pour refuser la demandes

    public function reject($id){
        $application = SupplierApplication::find($id);
        $application->statut = 'reject';
        $application->save();
        return redirect()->route('admin.applications')->with('success','Application rejeté.');
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
