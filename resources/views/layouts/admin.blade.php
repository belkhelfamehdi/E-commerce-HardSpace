<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="shortcut icon" href="{{secure_url('frontend/assets/images/logo/logo_black.png')}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administrateur</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ secure_url('js/init-alpine.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
</head>

<body class="font-roboto">
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        <aside class="z-10 w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
            <div class="mx-6 mt-4">
                <a href="{{route('index')}}" class="flex items-center">
                    <img id="logo" class="max-md:relative z-50 object-contain h-10 w-10" src="{{secure_url('frontend/assets/images/logo/Logo_black.png')}}" data-src="{{secure_url('frontend/assets/images/logo/Logo_black.png')}}"
                        alt="">
                        <span class="mx-3 font-semibold text-xl text-black">Hard<span class="text-pcolor">Space</span></span>
                </a>
            </div>
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        @if (Route::is('admin.dashboard'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-pcolor rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                            @endif
                        <a href="{{route('admin.dashboard')}}" class="inline-flex items-center w-full text-sm font-semibold @if (Route::is('admin.dashboard')) text-gray-800 @endif transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                            href="">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Tableau de bord</span>
                        </a>
                    </li>

                    <li class="relative px-6 py-3">
                        @if (Route::is('admin.users'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-pcolor rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                            @endif
                        <a href="{{route('admin.users')}}" class="inline-flex items-center w-full text-sm font-semibold @if (Route::is('admin.users')) text-gray-800 @endif transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                            href="">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Utilisateurs</span>
                        </a>
                    </li>

                    <li class="relative px-6 py-3">
                        @if (Route::is('admin.applications'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-pcolor rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                            @endif
                            @if (Route::is('admin.applications.show'))
                            <span class="absolute inset-y-0 left-0 w-1 bg-pcolor rounded-tr-lg rounded-br-lg"
                                aria-hidden="true"></span>
                                @endif
                        <a href="{{route('admin.applications')}}" class="inline-flex items-center w-full text-sm font-semibold @if (Route::is('admin.applications')) text-gray-800 @endif @if (Route::is('admin.applications.show')) text-gray-800 @endif transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                            href="">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Demandes fournisseur</span>
                        </a>
                    </li>

                    <li class="relative px-6 py-3">
                        @if (Route::is('admin.category'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-pcolor rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                            @endif
                            @if (Route::is('admin.category.create'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-pcolor rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                            @endif
                            @if (Route::is('admin.category.edit'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-pcolor rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                            @endif
                        <a href="{{route('admin.category')}}" class="inline-flex items-center w-full text-sm font-semibold @if (Route::is('admin.category')) text-gray-800 @endif @if (Route::is('admin.category.create')) text-gray-800 @endif @if (Route::is('admin.category.edit')) text-gray-800 @endif transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                            href="">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Categories</span>
                        </a>
                    </li>

                    <li class="relative px-6 py-3">
                        @if (Route::is('admin.brand'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-pcolor rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                            @endif
                            @if (Route::is('admin.brand.create'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-pcolor rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                            @endif
                            @if (Route::is('admin.brand.edit'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-pcolor rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                            @endif
                        <a href="{{route('admin.brand')}}" class="inline-flex items-center w-full text-sm font-semibold @if (Route::is('admin.brand')) text-gray-800 @endif @if (Route::is('admin.brand.create')) text-gray-800 @endif @if (Route::is('admin.brand.edit')) text-gray-800 @endif transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Marques</span>
                        </a>
                    </li>

                    <li class="relative px-6 py-3">
                        @if (Route::is('admin.products'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-pcolor rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                            @endif
                            @if (Route::is('admin.products.create'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-pcolor rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                            @endif
                            @if (Route::is('admin.products.edit'))
                        <span class="absolute inset-y-0 left-0 w-1 bg-pcolor rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                            @endif
                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 @if (Route::is('admin.products')) text-gray-800 @endif @if (Route::is('admin.products.create')) text-gray-800 @endif @if (Route::is('admin.products.edit')) text-gray-800 @endif hover:text-gray-800 dark:hover:text-gray-200"
                            href="{{route('admin.products')}}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                            <span class="ml-4">Produits</span>
                        </a>
                    </li>
            </div>
        </aside>
        <div class="flex flex-col flex-1 w-auto">
            <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
                <div
                    class="container flex flex-row-reverse items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
                    <ul class="flex  items-center flex-shrink-0 space-x-6">
                        <!-- Profile menu -->
                        <li class="relative">
                            <button class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                                @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account"
                                aria-haspopup="true">
                                <span class="text-black font-semibold">Salut! {{ Auth::user()->name }}</span>
                            </button>
                            <template x-if="isProfileMenuOpen">
                                <ul x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu"
                                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                                    aria-label="submenu">
                                    <li class="flex">
                                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="{{route('admin.logout')}}">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path
                                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            <span>Log out</span>
                                        </a>
                                    </li>
                                </ul>
                            </template>
                        </li>
                    </ul>
                </div>
            </header>
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Tableau de bord
                    </h2>
                    <!-- Cards -->
                    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div
                                class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total clients
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ \App\Models\User::count() }}
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div
                                class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total Produits
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ \App\Models\Product::count() }}
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div
                                class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total commandes
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ \App\Models\Order::count() }}
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div
                                class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Total messages
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    {{ \App\Models\SupplierApplication::count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>

</html>
