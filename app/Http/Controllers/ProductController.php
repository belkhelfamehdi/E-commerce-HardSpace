<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(5); 
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image_path = $request->file('image')->store('image/products', 'public');

        $product = Product::create([
            'brand_id' => $request->input('brand_id'),
            'category_id' => $request->input('category_id'),
            'product_name' => $request->input('product_name'),
            'product_code' => $request->input('product_code'),
            'product_qty' => $request->input('product_qty'),
            'product_thumbnail' => $image_path,
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            ]);
            return redirect()->route('admin.products')->with('success','Le produit a été créé.');
    }

    /**
     * Display the specified resource.
     */
    public function SearchProduct(Request $request)
    {
        $products = Product::all();
    if($request->keyword != ''){
    $products = Product::where('product_name','LIKE','%'.$request->keyword.'%')->get();
    }
    return response()->json([
        'products' => $products
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($request->hasFile('image')) {
            Storage::delete('public/' . $product->product_thumbnail);
            $image_path = $request->file('image')->store('image/products', 'public');
            $product->product_thumbnail = $image_path;
        }
        $product->update($request->all());
        return redirect()->route('admin.products')
                        ->with('success','Le produit a été mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        Storage::delete('public/' . $product->product_thumbnail);

        return redirect()->route('admin.products')
                        ->with('success','Le produit a été supprimé.');
    }
}
