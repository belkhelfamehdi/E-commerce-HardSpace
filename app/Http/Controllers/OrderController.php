<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    //effectuer une commande et generer une facture
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $cartItems = \Cart::getContent();

        foreach ($cartItems as $item) {
            Order::create([
                'user_id' => $user_id,
                'product_id' => $item->id,
                'price' => $item->price,
                'quantity' => $item->quantity,
            ]);
            $product = Product::find($item->id);
            $product->decrement('product_qty', $item->quantity);
        }

        \Cart::clear();

        $orders = Order::where('user_id', Auth::user()->id)->get();

        $pdf = new Dompdf();

        $html = view('frontend.frontend_layout.bill', compact('orders'))->render();

        $pdf->loadHtml($html);

        $pdf->setPaper('A4', 'portrait');

        $pdf->render();


        $response = $pdf->stream('bill.pdf');
        \Cart::clear();
        return $response; 
    }

    /**
     * Afficher la page mes commandes.
     */
    public function show(Order $order)
    {
        $user_id = auth()->id();
        $orders = Order::where('user_id', $user_id)->get();
        $products = Product::all();
        return view('profile.orders', compact('orders', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
