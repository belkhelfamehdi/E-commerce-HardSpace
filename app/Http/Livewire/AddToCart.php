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
    public $searchTerm = '';
    public $isNewArrival = false;
    public $isRecommended = false;

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
    public function updatedIsNewArrival()
{
    $this->render();
}
public function updatedIsRecommended()
{
    $this->render();
}
    public function render()
    {
        $query = Product::query();

        if ($this->isNewArrival && $this->isRecommended) {
            $query->where('new_arrival', 1)->where('featured', 1);
        } elseif ($this->isNewArrival) {
            $query->where('new_arrival', 1);
        } elseif ($this->isRecommended) {
            $query->where('featured', 1);
        }

        // Apply search query
        if ($this->searchTerm) {
            $query->where(function ($q) {
                $q->where('product_name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('description', 'like', '%' . $this->searchTerm . '%');
            });
        }
    
        // Apply sorting
        switch ($this->sortBy) {
            case 'popular':
                // Do nothing, as this is the default sorting option
                break;
            case 'newest':
                $query->orderByDesc('created_at');
                break;
            case 'oldest':
                $query->orderBy('created_at');
                break;
            case 'price_asc':
                $query->orderBy('price');
                break;
            case 'price_desc':
                $query->orderByDesc('price');
                break;
            case 'alpha_asc':
                $query->orderBy('product_name');
                break;
            default:
                break;
        }
    
        // Apply price filters
        if ($this->minPrice) {
            $query->where('price', '>=', $this->minPrice);
        }
    
        if ($this->maxPrice) {
            $query->where('price', '<=', $this->maxPrice);
        }
    
        $products = $query->paginate(9);
        $brand = Brand::all();
    
        return view('livewire.add-to-cart', [
            'products' => $products,
            'brand' => $brand,
        ]);
    }
}
