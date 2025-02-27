<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products on the admin page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::paginate(5);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Add a product to the shopping cart.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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
     * Show the form for creating a new product.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created product in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'images.*' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            'images' => 'max:3',
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

        return redirect()->route('admin.products')->with('success', 'Le produit a été créé.');
    }

    /**
     * Perform a dynamic search for products.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function SearchProduct(Request $request)
    {
        $products = Product::all();
        if ($request->keyword !== '') {
            $products = Product::where('product_name', 'LIKE', '%'.$request->keyword.'%')->get();
        }
        return response()->json([
            'products' => $products,
        ]);
    }

    /**
     * Show the form to edit the specified product.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified product in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048',
            ]);
            Storage::delete('public/' . $product->product_thumbnail);
            $image_path = $request->file('image')->store('image/products', 'public');
            $product->product_thumbnail = $image_path;
        }

        // Update featured field based on checkbox value
        $product->featured = $request->has('featured') ? true : false;

        // Update new_arrival field based on checkbox value
        $product->new_arrival = $request->has('new_arrival') ? true : false;

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
     * Remove the specified product from the database.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products')
            ->with('success', 'Le produit a été supprimé.');
    }
}
