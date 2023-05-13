<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AddToCart extends Component
{

    use WithPagination;

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
    public $minPrice;
public $maxPrice;


    public $sortBy = 'default';

    public function sortBy($order)
    {
        $this->sortBy = $order;
    }
    public function render()
    {
        $products = Product::query();

        switch ($this->sortBy) {
            case 'popular':
                // Do nothing, as this is the default sorting option
                break;
            case 'newest':
                $products = $products->orderByDesc('created_at');
                break;
            case 'oldest':
                $products = $products->orderBy('created_at');
                break;
            case 'price_asc':
                $products = $products->orderBy('price');
                break;
            case 'price_desc':
                $products = $products->orderByDesc('price');
                break;
            case 'alpha_asc':
                $products = $products->orderBy('product_name');
                break;
            default:
                break;
        }
        if ($this->minPrice) {
            $products->where('price', '>=', $this->minPrice);
        }

        if ($this->maxPrice) {
            $products->where('price', '<=', $this->maxPrice);
        }

        $products = $products->paginate(9);
        $brand = Brand::all();
        return view('livewire.add-to-cart', ['products' => $products, 'brand' => $brand]);
    }
}
