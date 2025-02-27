<?php

  namespace App\Http\Livewire;

  use Livewire\Component;

  class CartList extends Component
  {
      public $cartItems = [];
      protected $listeners = ['cartUpdated' => '$refresh'];

      //methode pour supprimer un produit du panier
      public function removeCart($id)
      {
          \Cart::remove($id);

          session()->flash('success', 'Item Cart Remove Successfully !');
          $this->emit('cartUpdated');
      }
      public function render()
      {
          //recuperer les informations du panier
          $this->cartItems = \Cart::getContent()->toArray();
          //recuperer le total prix
          $cart = \Cart::getTotalQuantity();

          return view('livewire.cart-list', ['cart' => $cart]);
      }
  }
