<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::paginate(9);
        $brand = Brand::all();
        return view('frontend.frontend_layout.store', compact('products', 'brand'));
    }

    public function product($id){
        $product = Product::findOrFail($id);
        $brand = Brand::all();
        $images = \App\Models\Image::where('product_id', $id)->get('photo_name');
        return view('frontend.frontend_layout.product', ['product' => $product, 'brand' => $brand, 'images' => $images]);
    }
    
}
