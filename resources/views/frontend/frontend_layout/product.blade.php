@extends('frontend.layout')

  @section('js')
    @vite('resources/js/product.js')
  @endsection
  @section('content')
    <section class="mb-20">
      <div class="bg-black opacity-75 absolute w-screen h-screen hidden z-50" id="light-1"></div>
      

      <!-- Contents -->
      <div class="container mx-auto text-base">

          <!-- Main Content -->
          <main class="w-full flex flex-col lg:flex-row">
              <!-- Gallery -->
              <section class="h-fit flex-col gap-8 mt-16 sm:flex sm:flex-row sm:gap-4 sm:h-full sm:mt-24 sm:mx-2 md:gap-8 md:mx-4 lg:flex-col lg:mx-0 lg:mt-36">
                  <picture class="main-image relative flex items-center rounded-lg bg-pcolor ">
                      <button class="bg-white w-10 h-10 flex items-center justify-center pr-1 rounded-full absolute left-1 z-10 sm:hidden" id="previous-mobile">
                    <svg
                      width="12"
                      height="18"
                      xmlns="http://www.w3.org/2000/svg"
                      id="previous-mobile"
                    >
                      <path
                        d="M11 1 3 9l8 8"
                        stroke="#1D2026"
                        stroke-width="3"
                        fill="none"
                        fill-rule="evenodd"
                        id="previous-mobile"
                      />
                    </svg>
                  </button>
                  <div class="Picture mx-auto">
                      <img src="{{url('frontend/assets/images/products/casque.webp')}}"
                          id="hero" />
                  </div>
                      <button class="bg-white w-10 h-10 flex items-center justify-center pl-1 rounded-full absolute right-1 z-10 sm:hidden" id="next-mobile">
                    <svg
                      width="13"
                      height="18"
                      xmlns="http://www.w3.org/2000/svg"
                      id="next-mobile"
                    >
                      <path
                        d="m2 1 8 8-8 8"
                        stroke="#1D2026"
                        stroke-width="3"
                        fill="none"
                        fill-rule="evenodd"
                        id="next-mobile"
                      />
                    </svg>
                  </button>
                  </picture>

                  <div class="thumbnails  hidden justify-between gap-4 m-auto sm:flex sm:flex-col sm:justify-start sm:items-center sm:h-fit md:gap-5 lg:flex-row">
                      <div id="1" class="w-1/5 bg-pcolor cursor-pointer rounded-xl sm:w-28 md:w-32 lg:w-[72px] xl:w-[78px] ring-active">
                          <img src="{{Storage::url($product->product_thumbnail)}}" alt="thumbnail" class="rounded-xl hover:opacity-50 transition active" id="thumb-1" />
                      </div>
                      @foreach($images as $image)
                      <div id="2" class="w-1/5 bg-pcolor cursor-pointer rounded-xl sm:w-28 md:w-32 lg:w-[72px] xl:w-[78px]">
                          <img src="{{ Storage::url($image->photo_name) }}" alt="thumbnail" class="rounded-xl hover:opacity-50 transition" id="thumb-2" />
                      </div>
                      @endforeach
                  </div>
              </section>

              <!-- Text -->
              <section class="w-full p-6 lg:mt-28 lg:pr-20 lg:py-10 2xl:pr-40 2xl:mt-40">
                  <h4 class="font-bold text-orange mb-2 uppercase text-xs tracking-widest">
                    {{$brand->firstWhere('id', $product->brand_id)->brand_name}}
                  </h4>
                  <h1 class="text-very-dark mb-4 font-bold text-3xl lg:text-4xl">
                      {{$product->product_name}}
                  </h1>
                  <p class="text-dark-grayish mb-6 text-base sm:text-lg whitespace-normal overflow-hidden break-words w-11/12 md:w-8/12 lg:w-8/12">
                    {{$product->description}}
                  </p>

                  <div class="flex items-center justify-between mb-6 sm:flex-col sm:items-start">
                      <div class="flex items-center gap-4">
                          <h3 class="text-very-dark font-bold text-3xl inline-block">
                            {{$product->price}} DZD 
                          </h3>
                  </div>
                </div>
      
                <div class="flex flex-col gap-5 justify-end mb-16 sm:flex-row lg:mb-0">
                  <div
                    class="w-full h-10 text-sm bg-light py-2 flex items-center justify-between rounded-lg font-bold relatives sm:w-80"
                  >

                      <button class="w-full h-10 bg-pcolor py-2 flex items-center justify-center gap-4 text-xs rounded-lg font-bold text-white shadow-md shadow-orange hover:brightness-125 transition select-none" id="add-cart">
                    <svg
                      width="16"
                      height="16"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 22 20"
                    >
                      <path
                        d="M20.925 3.641H3.863L3.61.816A.896.896 0 0 0 2.717 0H.897a.896.896 0 1 0 0 1.792h1l1.031 11.483c.073.828.52 1.726 1.291 2.336C2.83 17.385 4.099 20 6.359 20c1.875 0 3.197-1.87 2.554-3.642h4.905c-.642 1.77.677 3.642 2.555 3.642a2.72 2.72 0 0 0 2.717-2.717 2.72 2.72 0 0 0-2.717-2.717H6.365c-.681 0-1.274-.41-1.53-1.009l14.321-.842a.896.896 0 0 0 .817-.677l1.821-7.283a.897.897 0 0 0-.87-1.114ZM6.358 18.208a.926.926 0 0 1 0-1.85.926.926 0 0 1 0 1.85Zm10.015 0a.926.926 0 0 1 0-1.85.926.926 0 0 1 0 1.85Zm2.021-7.243-13.8.81-.57-6.341h15.753l-1.383 5.53Z"
                        fill="hsl(223, 64%, 98%)"
                        fill-rule="nonzero"
                      />
                    </svg>
                    Ajouter au panier
                  </button>
                  </div>
              </section>
          </main>
      </div>
    </section>
  @endsection
