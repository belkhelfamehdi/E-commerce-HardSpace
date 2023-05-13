<div>
    <section class="my-10">
        <h1 class="mb-10 text-center text-2xl font-bold">Panier</h1>
        <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
        <div class="rounded-lg md:w-2/3">
            @foreach ($cartItems as $item)
            <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
                <img class="h-40 w-40" src="{{Storage::url($item['attributes']['image'])}}" />
                <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                    <div class="mt-5 sm:mt-0">
                    <h2 class="text-lg font-bold text-gray-900">{{$item['name']}}</h2>
                    <p class="mt-1 text-xs text-gray-700">{{ $item['price'] }} DZD</p>
                    </div>
                    <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                    <div class="flex items-center border-gray-100">
                        <span wire:click="decrementQuantity('{{ $item['id'] }}')" class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-pcolor hover:text-blue-50"> - </span>
                        <input class="h-8 w-8 border bg-white text-center text-xs outline-none" type="number" value="{{$item['quantity']}}" min="1" />
                        <span wire:click="incrementQuantity('{{ $item['id'] }}')" class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-pcolor hover:text-blue-50"> + </span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <p class="text-sm truncate">{{ $item['price'] * $item['quantity'] }} DZD</p>
                        <svg wire:click="removeCart('{{ $item['id'] }}')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Sub total -->
        <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 w-1/2">
            @foreach ($cartItems as $item)
            <hr class="my-4" />
            <div class="flex justify-between">
            <p class="text-gray-700 ">{{$item['name']}}</p>
            <p class="text-gray-700 truncate">{{$item['price'] * $item['quantity']}} DZD</p>
            </div>
            @endforeach
            <hr class="my-4" />
            <div class="flex justify-between">
            <p class="text-lg font-bold">Total</p>
            <div class="">
                <p class="mb-1 text-lg font-bold">{{ Cart::getTotal() }} DZD</p>
            </div>
            </div>
            <form action="{{ route('order') }}" method="POST">
                @csrf
                <button type="submit" class="mt-6 w-full rounded-md bg-pcolor py-1.5 font-medium text-blue-50 hover:bg-orange-600">Commander</button>
            </form>
        </div>
        </div>
    </section>
</div>
