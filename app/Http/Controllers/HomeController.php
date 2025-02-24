<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class HomeController
 *
 * This controller handles the main home page and resource management related to it.
 */
class HomeController extends Controller
{
    /**
     * Display the home page with new arrival and recommended products.
     *
     * This method fetches new arrival and featured products to display on the homepage,
     * along with the list of available brands.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $new_arrival = \App\Models\Product::where('new_arrival', 1)->get();
        $recommended = \App\Models\Product::where('featured', 1)->get();
        $brand = \App\Models\Brand::all();
        return view('frontend.index', compact('new_arrival', 'recommended', 'brand'));
    }
}
