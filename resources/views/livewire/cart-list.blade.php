<div>
<div class="absolute top-0 right-5 bg-red-600 rounded-full w-4 h-4">
    <span class="text-white text-xs">{{ $cart}}</span>
</div>
<div class="cart_p absolute dark:bg-dcolor px-3  -right-7 top-[27px]  h-auto w-auto min-w-fit text-black bg-white z-50 opacity-0 transition-opacity ease-in-out duration-150 shadow-[0px_3px_6px_0px_#f7fafc] pointer-events-none">
    <div class="w-72 font-roboto text-[#1E1E1E]">
        @if (Cart::isEmpty())
        <div class="flex px-3 py-5 cursor-pointer border-b">
            <div class="flex-auto text-center pl-2 w-36">
                <div class="py-5 font-bold text-gray-500 text-lg">Votre panier est vide </div>
            </div>

        </div>
        @else
        <div class="max-h-52 overflow-y-auto">
        @foreach ($cartItems as $item)


        <div class="flex px-3 py-5 cursor-pointer border-b">
            <div><img class="h-[72px] w-[72px]" src="{{Storage::url($item['attributes']['image'])}}" alt="img product"></div>
            <div class="flex-auto text-left pl-2 w-36">
                <a href=""><h3 class="mb-2 font-medium text-sm hover:text-pcolor hover:underline">{{ $item['name'] }}</h3></a>
                <div class="truncate mb-2 font-light">{{ $item['price'] }} DA</div>
                <div class="font-light">Quantité: {{ $item['quantity'] }} </div>
            </div>
            <div class="flex flex-col w-18 font-medium items-end">
                <div class="w-4 h-4 mb-6 rounded-full cursor-pointer text-gray-500">
                        <button wire:click="removeCart({{$item['id']}})">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 hover:text-pcolor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg> 
                </button>                                           
                </div>
            </div>
        </div>
        @endforeach
    </div>
        @endif
        <div class="px-4">
            <div class="flex py-2 justify-between w-full font-medium text-sm">
                <span class="font-medium">Total</span>
                <span class="font-semibold">{{ Cart::getTotal() }} DZD</span>
            </div>
            <div class="flex py-2 mb-2 text-sm justify-between w-full">
                <a href="" class="bg-pcolor text-white hover:text-black hover:bg-white border hover:border-gray-300 px-6 py-2  font-medium">Votre panier</a>
                <a href="" class="bg-pcolor text-white hover:text-black hover:bg-white border hover:border-gray-300  px-4 py-2  font-medium">Commander</a>
            </div>
        </div>

        </div>
    </div>
</div>