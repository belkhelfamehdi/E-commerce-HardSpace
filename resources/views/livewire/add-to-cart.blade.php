<div id="store" class="container mx-auto my-20">
    <main class="container w- mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="hidden fixed inset-0 z-50 bg-black bg-opacity-25"></div>
      <div class="flex items-baseline justify-between border-b border-gray-200 pt-24 pb-6">
        <div class="flex items-center">
          <div class="backd opacity-0 pointer-events-none z-50 fixed inset-0 bg-black bg-opacity-25"></div>
          <div class="relative inline-block text-left" x-data = "{isOpen : false}">
            <div>
              <button type="button" class="sort-btn group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" @click ="isOpen = !isOpen" id="menu-button" aria-expanded="false" aria-haspopup="true">
                Trier par
                <svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
              </button>
            </div>
            <div class="sort absolute left-0 z-20 pointer-events-none mt-2 w-40 origin-top-left rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" :class="{'flex transition ease-in duration-100 transform opacity-100 scale-100 pointer-events-auto':isOpen}" x-show = "isOpen" @click.away="isOpen = false" x-transition:enter="transition ease-out duration-100 transform" x-transition:leave="transition ease-in duration-75 transform" x-transition:enter-start="opacity-0 scale-95">
              <div class="py-1">
                <button class="font-medium text-gray-900 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0" wire:click="sortBy('popularity')">Plus Populaire</button>
                <button class="hover:bg-pcolor text-gray-500 hover:text-gray-900 block px-4 py-2 text-sm" id="menu-item-2" wire:click="sortBy('newest')">Date, de la plus récente</button>
                <button class="hover:bg-pcolor text-gray-500 hover:text-gray-900 block px-4 py-2 text-sm" id="menu-item-2" wire:click="sortBy('oldest')">Date, de la plus ancienne</button>
                <button class="hover:bg-pcolor text-gray-500 hover:text-gray-900 block px-4 py-2 text-sm" id="menu-item-3" wire:click="sortBy('price_asc')">Prix: faible à élevé</button>
                <button class="hover:bg-pcolor text-gray-500 hover:text-gray-900 block px-4 py-2 text-sm" id="menu-item-4" wire:click="sortBy('price_desc')">Prix: élevé à faible</button>
                <button class="hover:bg-pcolor text-gray-500 hover:text-gray-900 block px-4 py-2 text-sm" id="menu-item-5" wire:click="sortBy('alpha_asc')">Ordre alphabétique A à Z</button>
              </div>
            </div>
          </div>
          <button type="button" class="togmenu lg:hidden -m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 ">
            <span class="sr-only">Filters</span>
            <svg class="moin h-5 w-5" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
        <div class="w-1/2">
                  
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input wire:model.debounce.500ms="searchTerm" type="text" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-pcolor focus:border-pcolor dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pcolor dark:focus:border-pcolor" placeholder="Search Laptops, Moniteurs, Accessoir..." required>
            </div>

        </div>
        <div class="hidden lg:flex justify-center space-x-1 dark:text-gray-100">
        </div>
      </div>

      <section class="pt-6 pb-24">
        <div class="flex flex-row mx-auto my-8 px-4 lg:px-0">
          <!-- Filters -->
        <div class="menu-f relative max-lg:fixed max-lg:left-0 max-lg:top-0 max-lg:z-50 max-lg:bg-white max-lg:flex max-lg:flex-col max-lg:inset-0 max-lg:px-10 max-lg:w-2/3 w-1/4 pr-4 transition ease-in-out duration-300 max-lg:transform max-lg:-translate-x-full">
          <button type="button" class="togmenu hidden absolute top-2 right-5 -mr-2 max-lg:flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400">
            <span class="sr-only">Close menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
          <form class="max-lg:my-auto lg:block">
            <div class="">
              <h3 class="font-medium text-gray-900">Prix</h3>

              <div class="mt-2">
                <div class="relative flex max-sm:flex-col items-center">
                
                  <input wire:model.debounce.500ms="minPrice" type="text" class="focus:ring-pcolor focus:border-pcolor block w-full pl-7 my-1 sm:mr-1 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Min">
                  <input wire:model.debounce.500ms="maxPrice"  type="text" class="focus:ring-pcolor focus:border-pcolor block w-full pl-7 sm:ml-1 my-1 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Max">
                </div>
              </div>
            </div>

            <div class="border-b border-gray-200 py-6">
              <h3 class="-my-3 flow-root">
                <!-- Expand/collapse section button -->
                <button type="button" class="cat flex w-full items-center justify-between bg-white py-3 text-sm text-gray-400 hover:text-gray-500" aria-controls="filter-section-1" aria-expanded="false">
                  <span class="font-medium text-gray-900">Tags</span>
                  <span class="ml-6 flex items-center">
                    <!-- Expand icon, show/hide based on section open state. -->
                    <svg class="-mr-1 h-5 w-5 -rotate-90 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                  </span>
                </button>
              </h3>
              <!-- Filter section, show/hide based on section state. -->
              <div class="hidden pt-6" id="filter-section-1">
                <div class="space-y-4">
                  <div class="flex items-center">
                    <input id="filter-category-0" name="category[]" value="new-arrival" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-pcolor focus:ring-pcolor" wire:model="isNewArrival">
                    <label for="filter-category-0" class="ml-3 text-sm text-gray-600">Nouvel arrivage</label>
                  </div>

                  <div class="flex items-center">
                    <input id="filter-category-1" name="category[]" value="Recommended" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-pcolor focus:ring-pcolor" wire:model="isRecommended">
                    <label for="filter-category-1" class="ml-3 text-sm text-gray-600">Recommendé</label>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <h3 class="font-bold py-7">Categories</h3>
              <ul id="list" class="space-y-4 border-b border-gray-200 pb-6 text-sm font-medium text-gray-900">

                @foreach ($categories as $category)
                <li>
                  <a href="" class="hover:text-pcolor transition-all ease-in-out duration-300 capitalize" value="{{$category->id}}" wire:click.prevent="filterByCategory({{ $category->id }})">{{ $category->category_name }}</a>
                </li>
              @endforeach
              </ul>
            </div>
          </form>
        </div>
          <!-- Product Grid -->
        <div class="w-3/4">
          <div class="product grid grid-cols-1 min-[394px]:justify-items-end mx-auto  lg:grid-cols-2 xl:grid-cols-3 gap-4">
            <!--here-->
            @foreach ($products as $product)
            <!-- Card 1 -->
                <div class="w-72 clamp bg-white dark:bg-dcolor shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                  <a href="{{ route('product', $product->id) }}">
                      <div class="scard relative w-62 h-70 bg-[#191919] rounded-3xl overflow-hidden">
                          <div class="relative w-full flex justify-center items-center pt-5 z-10">
                              <img class="max-w-full transition-all duration-[0.5s]" src="{{ Storage::url($product->product_thumbnail) }}" alt="headphone">
                          </div>
                      </div>
                      <div class="px-4 py-3 w-72">
                        <span class="text-gray-400 mr-3 uppercase text-xs">{{$brand->firstWhere('id', $product->brand_id)->brand_name}}</span>
                          <p class="text-lg font-bold text-black dark:text-gray-200 truncate block capitalize">{{$product->product_name}}</p>
                          <div class="flex items-center">
                              <p class="text-lg font-semibold text-black dark:text-gray-200 cursor-auto my-3">{{$product->price}} DZD</p>
                              <div class="ml-auto">
                                <form wire:submit.prevent="addToCart({{ $product }})">
                                    @csrf
                                    <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                    d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                    <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                    </svg>
                                    </button>
                                    </form>
        
                            </div>
                          </div>
                      </div>
                  </a>
              </div>
              @endforeach
            </div>
            <div class="my-4 py-4 border-t border-gray-200 space-x-1 dark:text-gray-100">
              {{ $products->links() }}
          </div>
          
          </div>
        </div>