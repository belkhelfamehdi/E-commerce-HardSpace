<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(5); 
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $brands = Brand::create([
            'brand_name' => $request->input('brand_name'),
            ]);

            return redirect()->route('admin.brand')->with('success','La marque a été créé.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function SearchCategory(Request $request)
    {
        $brands = Brand::all();
    if($request->keyword != ''){
    $brands = Brand::where('brand_name','LIKE','%'.$request->keyword.'%')->get();
    }
    return response()->json([
        'brands' => $brands
    ]);
    }

    //show edit brands page

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $brands = Brand::findOrFail($id);
        $brands->update($request->all());
        return redirect()->route('admin.brand')
                        ->with('success','La marque a été mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brands = Brand::findOrFail($id);
        $brands->delete();

        return redirect()->route('admin.brand')
                        ->with('success','La marque a été supprimé.');
    }
}
