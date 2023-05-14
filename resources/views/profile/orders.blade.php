@extends('frontend.layout')

  @section('js')
    @vite('resources/js/store.js')
  @endsection
  @section('content')

<div class="bg-white py-10">
    <div class="py-16 sm:py-24">
      <div class="max-w-7xl mx-auto sm:px-2 lg:px-8">
        <div class="max-w-2xl mx-auto px-4 lg:max-w-4xl lg:px-0">
          <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Mes commande</h1>
          <p class="mt-2 text-sm text-gray-500">Consultez l'historique de vos commandes passées.</p>
        </div>
      </div>

      @if (App\Models\Order::count() == 0)
          
      <div class="mt-10 flex justify-center">
        <h1 class="text-lg font-bold">Pas de commandes effectué</h1>
      </div>
      @else
          

  @foreach ($orders as $order)
      

      <div class="mt-5">
        <h2 class="sr-only">Commandes récentes</h2>
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-8">
          <div class="max-w-2xl mx-auto space-y-8 sm:px-4 lg:max-w-4xl lg:px-0">
            <div class="bg-white border-t border-b border-gray-200 shadow-sm sm:rounded-lg sm:border">
              <h3 class="sr-only">Commande passée le <time datetime="2021-07-06">{{$order->created_at}}</time></h3>
  
              <div class="flex items-center p-4 border-b border-gray-200 sm:p-6 sm:grid sm:grid-cols-4 sm:gap-x-6">
                <dl class="flex-1 grid grid-cols-2 gap-x-6 text-sm sm:col-span-3 sm:grid-cols-3 lg:col-span-2">
                  <div>
                    <dt class="font-medium text-gray-900">Code</dt>
                    <dd class="mt-1 text-gray-500">{{$order->id}}</dd>
                  </div>
                  <div class="hidden sm:block">
                    <dt class="font-medium text-gray-900">Date</dt>
                    <dd class="mt-1 text-gray-500">
                      <time datetime="2021-07-06">{{$order->created_at}}</time>
                    </dd>
                  </div>
                  <div>
                    <dt class="font-medium text-gray-900">Prix total</dt>
                    <dd class="mt-1 font-medium text-gray-900">{{$order->price * $order->quantity}}.00 DZD</dd>
                  </div>
                </dl>
  
                <div class="relative flex justify-end lg:hidden">
                  <div class="flex items-center">
                    <button type="button" class="-m-2 p-2 flex items-center text-gray-400 hover:text-gray-500" id="menu-0-button" aria-expanded="false" aria-haspopup="true">
                      <span class="sr-only">Options pour la commande {{$order->id}}</span>
                      <!-- Heroicon name: outline/dots-vertical -->
                      <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
  
              <!-- Products -->
              <h4 class="sr-only">Articles</h4>
              <ul role="list" class="divide-y divide-gray-200">
                <li class="p-4 sm:p-6">
                  <div class="flex items-center sm:items-start">
                    <div class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden sm:w-40 sm:h-40">
                      <img src="{{ Storage::url(DB::table('products')->where('id', $order->product_id)->value('product_thumbnail')) }}" alt="Moss green canvas compact backpack with double top zipper, zipper front pouch, and matching carry handle and backpack straps." class="w-full h-full object-center object-cover">
                    </div>
                    <div class="flex-1 ml-6 text-sm">
                      <div class="font-medium text-gray-900 sm:flex sm:justify-between">
                        <h5>Micro Backpack</h5>
                        <p class="mt-2 sm:mt-0">{{DB::table('products')->where('id', $order->product_id)->value('price')}}.00 DZD</p>
                      </div>
                      <p class="hidden text-gray-500 sm:block sm:mt-2">{{DB::table('products')->where('id', $order->product_id)->value('description')}}</p>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
  
            <!-- More orders... -->
          </div>
        </div>
      </div>
      @endforeach
      @endif

    </div>
  </div>

@endsection