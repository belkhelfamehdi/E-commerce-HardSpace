<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{

    protected $listeners = ['cartUpdated' => '$refresh'];
    public $cartItems = [];
    public function incrementQuantity($itemId)
    {
        
        $item = \Cart::get($itemId);
        $qty = 1;
        \Cart::update($itemId, array(
            'quantity' => $qty
        ));
        $this->emit('cartUpdated');
    }
    public function decrementQuantity($itemId)
    {
        $item = \Cart::get($itemId);
        $qty = -1;
        \Cart::update($itemId, array(
            'quantity' => $qty
        ));
        $this->emit('cartUpdated');
    }

    public function removeCart($id)
    {
          \Cart::remove($id);
  
          session()->flash('success', 'Item Cart Remove Successfully !');
          $this->emit('cartUpdated');
    }

    public function render()
    {
        $this->cartItems = \Cart::getContent()->toArray();
        return view('livewire.cart');
    }
}
