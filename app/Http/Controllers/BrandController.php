<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class BrandController
 *
 * This controller handles the CRUD operations for brands.
 */
class BrandController extends Controller
{
    /**
     * Display a listing of the brands.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $brands = Brand::paginate(5);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new brand.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created brand in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $brands = Brand::create([
            'brand_name' => $request->input('brand_name'),
            ]);

            return redirect()->route('admin.brand')->with('success','La marque a été créé.');
    }

    /**
     * Search for brands by keyword.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
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

    /**
     * Show the form for editing the specified brand.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified brand in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $brands = Brand::findOrFail($id);
        $brands->update($request->all());
        return redirect()->route('admin.brand')
                        ->with('success','La marque a été mis à jour.');
    }

    /**
     * Remove the specified brand from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function destroy($id)
    {
        $brands = Brand::findOrFail($id);
        $brands->delete();

        return redirect()->route('admin.brand')
                        ->with('success','La marque a été supprimé.');
    }
}
