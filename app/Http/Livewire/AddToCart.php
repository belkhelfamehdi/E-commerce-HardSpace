<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class AddToCart extends Component
{

    public $productId;
    public $name;
    public $price;
    public $quantity = 1;

    public function addToCart($product)
    {
        // Ensure $product is an object with an "id" property
        $productObject = (object) $product;
    
        \Cart::add([
            'id' => $productObject->id,
            'name' => $productObject->product_name,
            'price' => $productObject->price,
            'quantity' => $this->quantity,
            'attributes' => [
                'image' => $productObject->product_thumbnail,
            ]
        ]);
        $this->emit('cartUpdated');
    }
    public function render()
    {
        $products = Product::paginate(9);
        return view('livewire.add-to-cart', ['products' => $products]);
    }
}
