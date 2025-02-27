<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class OrderController
 *
 * This controller handles order processing, invoice generation, and displaying user orders.
 */
class OrderController extends Controller
{
    /**
     * Store an order, generate an invoice, and process the cart items.
     *
     * This method is responsible for storing the order information in the database,
     * decrementing product quantities, clearing the cart, and generating a PDF invoice for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
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
     * Display the user's orders on the "Mes commandes" page.
     *
     * This method retrieves the orders of the authenticated user and displays them on the profile's orders page.
     *
     * @param  \App\Models\Order  $order
     *
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        $user_id = auth()->id();
        $orders = Order::where('user_id', $user_id)->get();
        $products = Product::all();
        return view('profile.orders', compact('orders', 'products'));
    }
}
