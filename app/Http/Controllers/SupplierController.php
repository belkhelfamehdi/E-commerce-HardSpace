<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    /**
     * Afficher la liste des demandes fournisseur.
     */
    public function index()
    {
        $products = Product::where('supplier_id', auth()->id())->paginate(5);
        return view('supplier.products.index', compact('products'));
    }


    //afficher index fournisseur
    public function home(){
        return view('supplier.index');
    }

    /**
     * Show the form for creating a new products.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('supplier.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created products in database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'images.*' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'images' => 'max:3',
            '*' => 'required'
        ]);
        $image_path = $request->file('image')->store('image/products/thumbnail', 'public');


            $images = $request->file('images');

        $product = Product::create([
            'brand_id' => $request->input('brands'),
            'category_id' => $request->input('category'),
            'product_name' => $request->input('product_name'),
            'product_code' => $request->input('product_code'),
            'product_qty' => $request->input('product_qty'),
            'supplier_id' => Auth::user()->id,
            'product_thumbnail' => $image_path,
            'price' => $request->input('price'),

            'description' => $request->input('description'),
            ]);

            $imagePaths = [];
            foreach ($images as $images_path) {
                $path = $images_path->store('image/products/images', 'public');
                $imagePaths[] = $path;
                $image = \App\Models\Image::create([
                    'product_id' => $product->id,
                    'photo_name' => $path,
                ]);
            }

            return redirect()->route('supplier.products')->with('success','Le produit a été créé.');
    }

    /**
     * Methode pour recherche des produits.
     */
    public function SearchProduct(Request $request)
    {
        $products = collect();
        if($request->keyword != ''){
        $products = Product::where('supplier_id', auth()->id())->where('product_name','LIKE','%'.$request->keyword.'%')->get();
    }
    return response()->json([
        'products' => $products
    ]);
    }

    /**
     * Show the form for editing the products.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('supplier.products.edit', compact('product'));
    }

    /**
     * Update the specified products.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048'
            ]);
            Storage::delete('public/' . $product->product_thumbnail);
            $image_path = $request->file('image')->store('image/products', 'public');
            $product->product_thumbnail = $image_path;
        }
        $product->update($request->all());
        return redirect()->route('supplier.products')
                        ->with('success','Le produit a été mis à jour.');
    }

    /**
     * Remove the specified products.
     */
    public function destroy(string $id)
    {

        $product = Product::findOrFail($id);

        $images = \App\Models\Image::where('product_id', $id)->get();
        foreach ($images as $image) {
            $image->delete();
            Storage::delete('public/' . $image->photo_name);
        }
        $product->delete();
        Storage::delete('public/' . $product->product_thumbnail);


        return redirect()->route('supplier.products')
                        ->with('success','Le produit a été supprimé.');
    }
}
