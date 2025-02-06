<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="shortcut icon" href="{{url('frontend/assets/images/logo/logo_black.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
    @yield('js')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{secure_url('frontend/assets/vendor/css/swiper-bundle.min.css') }}" />
    @livewireStyles
</head>

<body class="font-roboto dark:bg-dcolor ">

    <header class="text-white relative h-auto max-w-full ease-in duration-200">
        <nav class="md:fixed z-30 md:top-0 w-full ease-in duration-200 bg-[#0c0a0a] border-b border-solid border-[#323232]" aria-label="Main Navigation">
            <div class="container mx-auto px-4 py-2 pt-4 flex items-center justify-between flex-wrap md:px-5">
                <a href="{{route('index')}}" class="flex items-center">
                    <img id="logo" class="max-md:relative z-50 object-contain h-12 w-12" src="{{url('frontend/assets/images/logo/Logo_white.png')}}" data-src="{{url('frontend/assets/images/logo/Logo_black.png')}}"
                        alt="">
                        <span class="mx-3 font-semibold text-xl">Hard<span class="text-pcolor">Space</span></span>
                </a>
                <div x-data="{ open: false }">
                    <button class="md:hidden text-gray-200 w-10 h-10  z-50 focus:outline-none nav-toggler" :class="{'text-black dark:text-gray-200 fixed right-6 top-6': open,' text-gray-200 relative': !open }" id="humburger" @click="open = !open" data-target="#navigation">
                              <span class="sr-only">Open main menu</span>
                              <div class="block w-5 absolute left-1/2 top-1/2   transform  -translate-x-1/2 -translate-y-1/2">
                                  <span aria-hidden="true" class="block absolute h-0.5 w-5 bg-current transform transition duration-500 ease-in-out" :class="{'rotate-45': open,' -translate-y-1.5': !open }"></span>
                                  <span aria-hidden="true" class="block absolute  h-0.5 w-5 bg-current   transform transition duration-500 ease-in-out" :class="{'opacity-0': open } "></span>
                                  <span aria-hidden="true" class="block absolute  h-0.5 w-5 bg-current transform  transition duration-500 ease-in-out" :class="{'-rotate-45': open, ' translate-y-1.5': !open}"></span>
                              </div>
                          </button>
                </div>

                <div  class="max-md:hidden max-md:text-black max-md:dark:text-white text-sm bg-white dark:bg-dcolor md:bg-transparent max-md:fixed max-md:h-screen z-40 top-0 left-0  md:relative mx-auto w-full text-center md:flex md:order-2 md:flex-grow md:w-auto" id="navigation">
                    <ul class="nav-i max-md:relative max-md:top-20 pt-5 md:pt-0 md:flex-grow md:justify-center flex max-md:flex-col">
                        <li class="lg:mx-8 md:mx-4 py-2 transition-all ease-in-out duration-100 hover:scale-110 hover:text-pcolor"><a href="{{route('index')}}" class="capitalize">Accueil</a></li>
                        <li class="lg:mx-8 md:mx-4 py-2 transition-all ease-in-out duration-100 hover:scale-110 hover:text-pcolor"><a href="{{route('store')}}" class="capitalize">Produits</a></li>
                        <li class="lg:mx-8 md:mx-4 py-2 transition-all ease-in-out duration-100 hover:scale-110 hover:text-pcolor"><a href="{{route('cart')}}" class="capitalize">Panier</a></li>
                        <li class="lg:mx-8 md:mx-4 py-2 transition-all ease-in-out duration-100 hover:scale-110 hover:text-pcolor"><a href="{{route('contact')}}" class="capitalize">Contactez-nous</a></li>
                    </ul>
                    <div class="btn-i max-md:relative max-md:top-20 pt-5 justify-center md:pt-0 mt-2 lg:pr-4 flex w-auto " x-data = "{search : false}">
                      <div class="searchbar md:-left-full absolute right-8 md:right-0 md:-top-4 flex ml-96 mb-5 transition-all ease-in-out duration-300" :class = "{'invisible opacity-0 translate-x-2':!search, 'visible opacity-100 translate-x-0': search}">
                        <form action="" class="flex">
                          <input type="text" class="bg-gray-200 text-black focus:outline-none focus:ring-2 focus:ring-pcolor focus:border-transparent rounded-sm py-2 px-4 block w-52 md:w-64 appearance-none leading-normal" placeholder="Rechercher un produit">
                          <div class="bg-pcolor w-12 h-[42px]">
                            <span><i class="search fa-solid fa-magnifying-glass fa-lg text-white mt-5 cursor-pointer"></i></span>
                          </div>
                        </form>
                        <div class="bg-black w-12 h-[42px]">
                          <span class="" @click="search = !search"><i class="search fa-regular fa-x fa-lg text-white mt-5 cursor-pointer"></i></span>
                        </div>
                      </div>
                      <div class="def-i">
                        <span class="search" @click="search = !search"><i class="fa-solid fa-magnifying-glass mr-4 fa-lg md:py-2 md:px-3 cursor-pointer transition-all ease-in-out duration-100 hover:scale-105 hover:text-pcolor"></i></span>
                        <span class="relative user"><a href="@if(Auth::guest()){{route('login')}} @else {{route('profile.show')}} @endif"><i class="fa-solid fa-user fa-lg mx-4 md:py-2 md:px-3 cursor-pointer transition-all ease-in-out duration-300 hover:text-pcolor justify-between"></i></a>
                            @if(Auth::guest())
                            <div class="login absolute dark:bg-dcolor top-[18px] -left-40 p-3 h-auto w-auto min-w-fit text-black bg-white z-50 opacity-0 transition-opacity ease-in-out duration-150 shadow-[0px_3px_6px_0px_#f7fafc] pointer-events-none">
                                <form action="{{route('login')}}" method="POST" class="font-normal">
                                    @csrf
                                    <ul class="m-2 text-red-700 text-xs text-left list-disc list-inside">
                                        @error('email')
                                            <li>{{ $message }}</li>
                                        @enderror
                                        @error('password')
                                        <li>{{ $message }}</li>
                                        @enderror
                                    </ul>
                                    <input class="m-2 w-52 h-auto p-1 dark:bg-gray-900 dark:text-gray-100 border-gray-300 text-xs focus:outline-none focus:ring-0 focus:border-gray-300 placeholder:text-gray-600" name="email" type="email" placeholder="E-mail">
                                    <input class="m-2 w-52 h-auto p-1 dark:bg-gray-900 dark:text-gray-100 border-gray-300 text-xs focus:outline-none focus:ring-0 focus:border-gray-300 placeholder:text-gray-600" name="password" type="password" placeholder="Password">
                                    <button class="m-2 px-6 py-2 rounded-sm text-white bg-pcolor" type="submit">Connexion</button>
                                </form>
                                <div class="flex m-2 text-gray-600 text-xs hover:text-pcolor">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 my-auto">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                    <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                                </div>
                                <div class="flex m-2 text-gray-600 text-xs hover:text-pcolor">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 my-auto">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                    <a href="{{route('register')}}">Créer un compte</a>
                                </div>
                            </div>
                            @else
                            <div class="login absolute text-gray-600 dark:text-gray-100 dark:bg-dcolor top-[18px] -left-28 p-3 h-auto w-auto min-w-fit text-black bg-white z-50 opacity-0 transition-opacity ease-in-out duration-150 shadow-[0px_3px_6px_0px_#f7fafc] pointer-events-none">
                                <div class="flex m-1 w-40 font-semibold  text-xs">
                                    <span><span class="text-sm capitalize">Salut, </span>{{Auth::user()->FirstName}} {{Auth::user()->LastName}}</span>
                                </div>
                                @if (Auth::user()->role == "supplier")
                                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                                <div class="flex m-1  text-xs hover:text-pcolor">
                                    <a href="{{route('supplier.dashboard')}}">Tableau de board</a>
                                </div>
                                @endif
                                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                                <div class="flex m-1  text-xs hover:text-pcolor">
                                    <a href="{{route('profile.show')}}">Mon compte</a>
                                </div>
                                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                                <div class="flex m-1  text-xs hover:text-pcolor">
                                    <a href="{{route('orders')}}">Mes commandes</a>
                                </div>
                                <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
                                    <form action="{{route('logout')}}" method="POST">
                                        @csrf
                                    <div class="flex m-1 text-xs hover:text-pcolor">
                                        <button type="submit">Déconnexion</button>
                                    </div>
                                    </form>

                            </div>
                            @endif
                        </span>
                        <span class="cart"><a href="{{route('cart')}}"><i class="fa-solid fa-cart-shopping ml-4 fa-lg md:py-2 md:px-3 cursor-pointer transition-all ease-in-out duration-100 hover:scale-105 hover:text-pcolor"></i></a>
                            <livewire:cart-list />
                        </span>
                            </div>
                        </span>
                      </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    @yield('content')
    <footer aria-label="Site Footer" class="bg-black dark:bg-gray-900 max-w-full">
        <div>
            <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
                <div class="lg:flex lg:items-start lg:gap-8">

                    <div class="mt-8 grid grid-cols-2 gap-8 lg:mt-0 lg:grid-cols-5 lg:gap-y-16">
                        <div class="col-span-2">
                            <div>
                                <h2 class="text-2xl font-bold text-white text-center uppercase">
                                    ABONNEZ-VOUS A NOTRE NEWSLETTER POUR RECEVOIR TOUTE LES NOUVELLES
                                </h2>
                            </div>
                        </div>

                        <div class="col-span-2 lg:col-span-3 lg:flex lg:items-end ">
                            <form class="w-full">
                                <label for="UserEmail" class="sr-only"> Email </label>

                                <div class="border border-white p-2 focus-within:ring sm:flex sm:items-center sm:gap-4">
                                    <input type="email" id="UserEmail" placeholder="Votre adresse email" class="w-full border-none focus:border-transparent focus:ring-transparent sm:text-sm" />

                                    <button class="mt-1 w-full bg-pcolor px-6 py-3 text-sm font-bold uppercase tracking-wide text-white transition-colors duration-200 hover:bg-white hover:text-black sm:mt-0 sm:w-auto sm:flex-shrink-0">
                                S'abonner
                              </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="max-w-screen-xl px-4 py-16 mx-auto space-y-8 sm:px-6 lg:space-y-16 lg:px-8 ">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <div class=" max-lg:mx-auto justify-center">
                    <div class="justify-center">
                        <img class="h-20 w-20 mx-auto" src="{{url('frontend/assets/images/logo/Logo_white.png')}}" alt="">
                    </div>

                    <p class=" mt-4 text-center text-xl font-bold  text-white dark:text-gray-400">
                       Haute qualité, Haute performance
                    </p>

                    <ul class="flex justify-center gap-6 mt-8 ">
                        <li>
                            <a href="/" rel="noreferrer" target="_blank" class="text-gray-400 transition hover:text-pcolor dark:text-gray-200">
                                <span class="sr-only">Facebook</span>

                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                          <path
                            fill-rule="evenodd"
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                            clip-rule="evenodd"
                          />
                        </svg>
                            </a>
                        </li>

                        <li>
                            <a href="/" rel="noreferrer" target="_blank" class="text-gray-400 transition hover:text-pcolor dark:text-gray-200">
                                <span class="sr-only">Instagram</span>

                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                          <path
                            fill-rule="evenodd"
                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                            clip-rule="evenodd"
                          />
                        </svg>
                            </a>
                        </li>

                        <li>
                            <a href="/" rel="noreferrer" target="_blank" class="text-gray-400 transition hover:text-pcolor dark:text-gray-200">
                                <span class="sr-only">Twitter</span>

                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                          <path
                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"
                          />
                        </svg>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:col-span-2 lg:grid-cols-3">


                    <div>
                        <p class="font-medium text-white">Liens</p>

                        <nav aria-label="Footer Navigation - Company" class="mt-6">
                            <ul class="space-y-4 text-sm">
                                <li>
                                    <a href="#" class="text-white transition hover:text-pcolor dark:text-gray-200">
                          Accueil
                          </a>
                                </li>

                                <li>
                                    <a href="#" class="text-white transition hover:text-pcolor dark:text-gray-200">
                          Produits
                          </a>
                                </li>

                                <li>
                                    <a href="#" class="text-white transition hover:text-pcolor dark:text-gray-200">
                          Connexion
                          </a>
                                </li>
                                <li>
                                    <a href="#" class="text-white transition hover:text-pcolor dark:text-gray-200">
                          S'inscrire
                          </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div>
                        <p class="font-medium text-white">A propos de nous</p>

                        <nav aria-label="Footer Navigation - Legal" class="mt-6">
                            <ul class="space-y-4 text-sm">
                                <li>
                                    <a href="#" class="text-white transition hover:text-pcolor dark:text-gray-200">
                          Qui somme nous?
                          </a>
                                </li>

                                <li>
                                    <a href="#" class="text-white transition hover:text-pcolor dark:text-gray-200">
                          FAQ
                          </a>
                                </li>

                                <li>
                                    <a href="#" class="text-white transition hover:text-pcolor dark:text-gray-200">
                          Contactez-nous
                          </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <p class="text-xs text-gray-500 dark:text-gray-400 border-t border-gray-100 pt-8">
                &copy; 2023. HardSpace. All rights reserved.
            </p>
        </div>
    </footer>
    <script src="{{ secure_url('frontend/assets/vendor/js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ secure_url('frontend/assets/vendor/js/fontawesome.js') }}"></script>
    @livewireScripts
</body>

</html>
