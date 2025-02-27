<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;

/**
 * Class ProductsController
 *
 * This controller handles product-related functionality for the frontend.
 */
class ProductsController extends Controller
{
    /**
     * Display a paginated list of products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::paginate(9);
        $brand = Brand::all();
        return view('frontend.frontend_layout.store', compact('products', 'brand'));
    }

    /**
     * Display a single product with its images.
     *
     * @param  int  $id  The ID of the product.
     *
     * @return \Illuminate\View\View
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function product($id)
    {
        $product = Product::findOrFail($id);
        $brand = Brand::all();
        $images = \App\Models\Image::where('product_id', $id)->get('photo_name');
        return view('frontend.frontend_layout.product', ['product' => $product, 'brand' => $brand, 'images' => $images]);
    }
}
