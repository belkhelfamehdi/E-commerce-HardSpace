<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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


        public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,

        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');

        return redirect()->route('cart');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'images.*' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'images' => 'max:3'
        ]);
        $image_path = $request->file('image')->store('image/products/thumbnail', 'public');

        

            $images = $request->file('images');

            $recommended = $request->input('recommended') ? 1 : 0;
            $new_arrival = $request->input('new_arrival') ? 1 : 0;

        $product = Product::create([
            'brand_id' => $request->input('brand_id'),
            'category_id' => $request->input('category'),
            'product_name' => $request->input('product_name'),
            'product_code' => $request->input('product_code'),
            'product_qty' => $request->input('product_qty'),
            'product_thumbnail' => $image_path,
            'price' => $request->input('price'),
            'featured' => $recommended,
            'new_arrival' => $new_arrival,
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
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
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
    
                // Update featured field based on checkbox value
                $product->featured = $request->has('featured') ? 1 : 0;
    
                // Update new_arrival field based on checkbox value
                $product->new_arrival = $request->has('new_arrival') ? 1 : 0;
    
                $product->product_name = $request->input('product_name');
                $product->product_code = $request->input('product_code');
                $product->product_qty = $request->input('product_qty');
                $product->price = $request->input('price');
                $product->description = $request->input('description');
                $product->category_id = $request->input('category');
                $product->brand_id = $request->input('brands');
                $product->save();

        return redirect()->route('admin.products')
                        ->with('success', 'Le produit a été mis à jour.');
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
