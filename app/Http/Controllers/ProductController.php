<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'images.*' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'images' => 'max:3'
        ]);
        $image_path = $request->file('image')->store('image/products/thumbnail', 'public');

        

            $images = $request->file('images');


        $product = Product::create([
            'brand_id' => $request->input('brand_id'),
            'category_id' => $request->input('category'),
            'product_name' => $request->input('product_name'),
            'product_code' => $request->input('product_code'),
            'product_qty' => $request->input('product_qty'),
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
            $request->validate([
                'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048'
            ]);
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
        
        $images = \App\Models\Image::where('product_id', $id)->get();
        foreach ($images as $image) {
            $image->delete();
            Storage::delete('public/' . $image->photo_name);
        }
        $product->delete();
        Storage::delete('public/' . $product->product_thumbnail);


        return redirect()->route('admin.products')
                        ->with('success','Le produit a été supprimé.');
    }
}
