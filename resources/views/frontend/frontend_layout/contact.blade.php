@extends('frontend.layout')
@section('js')
    @vite('resources/js/product.js')
@endsection
@section('content')
    <section class="dark:bg-dcolor text-black border-t border-b border-scolor border-solid">
        <section>
            <div
                class="container grid w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 py-14 my-14">
                <div class="w-auto justify-items-center text-3xl text-center mx-10">
                    <i class="fa-solid fa-phone fa-2xl  mx-auto"></i>
                    <h2 class="text-2xl font-medium py-8">Numéro de téléphone</h2>
                    <p class="text-base font-medium text-tscolor">Appelez-nous au (du Lundi au Samdi): <br>
                        +2137777777.</p>
                </div>
                <div class="w-auto justify-items-center text-3xl text-center mx-10">
                    <i class="fa-solid fa-location fa-2xl mx-auto"></i>
                    <h2 class="text-2xl font-medium py-8">Adresse</h2>
                    <p class="text-base font-medium text-tscolor">Université Abderrahmane Mira <br>
                        Béjaïa - Algérie.</p>
                </div>
                <div class="w-auto justify-items-center text-3xl text-center mx-10">
                    <i class="fa-regular fa-message fa-2xl mx-auto"></i>
                    <h2 class="text-2xl font-medium py-8">Email</h2>
                    <p class="text-base font-medium text-tscolor">Ecrivez-nous sur l'adresse-email: <br>
                        Contact@Hardspace.com.</p>
                </div>
            </div>
        </section>
        <section>
            <div class="flex items-center justify-center h-screen md:my-20">
                <div class="min-w-fit w-96 max-md:w-full flex-col border bg-white px-6 py-10 shadow-md rounded-[4px] ">
                    <div class="mb-4 flex justify-center">
                        <img id="logo" class="max-md:relative object-contain h-24 w-24"
                            src="{{ url('frontend/assets/images/logo/Logo_black.png') }}">
                    </div>
                    <div class="my-4 text-center mx-auto ">
                        <h1 class="text-3xl font-semibold my-3">Contacter-nous</h1>
                    </div>
                    <form action="{{ route('contact') }}" method="POST">
                        @if (Auth::guest())
                            <div class="flex flex-col text-sm rounded-md">
                                <input name="name" :value="old('name')" required autofocus autocomplete="name"
                                    class="mb-2 rounded-[4px] border p-3 hover:outline-none focus:ring-pcolor focus:border-pcolor hover:border-pcolor "
                                    type="text" placeholder="Entrez votre Nom" />
                                <input name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom"
                                    class="border mt-3 mb-2 rounded-[4px] p-3 hover:outline-none focus:ring-pcolor focus:border-pcolor hover:border-pcolor "
                                    type="text" placeholder="Entrez votre Prénom" />
                                <input name="email"
                                    class="border mt-3 mb-2 rounded-[4px] p-3 hover:outline-none focus:ring-pcolor focus:border-pcolor hover:border-pcolor "
                                    type="text" placeholder="Entrez votre Email" />
                                <textarea name="message" cols="30" rows="10"
                                    class="border mt-3 mb-2 rounded-[4px] p-3 hover:outline-none focus:ring-pcolor focus:border-pcolor hover:border-pcolor"
                                    placeholder="Entrez votre Message"></textarea>
                            </div>
                        @else
                            <div class="flex flex-col text-sm rounded-md">
                                <input id="LastName" name="LastName" :value="old('LastName')" required autofocus
                                    autocomplete="LastName"
                                    class="mb-2 rounded-[4px] border p-3 hover:outline-none focus:ring-pcolor focus:border-pcolor hover:border-pcolor "
                                    type="text" value={{ Auth::user()->LastName }} />
                                <input name="FirstName" :value="old('FirstName')" required autofocus autocomplete="FirstName"
                                    class="border mt-3 mb-2 rounded-[4px] p-3 hover:outline-none focus:ring-pcolor focus:border-pcolor hover:border-pcolor "
                                    type="text" value={{ Auth::user()->FirstName }} />
                                <input name="email"
                                    class="border mt-3 mb-2 rounded-[4px] p-3 hover:outline-none focus:ring-pcolor focus:border-pcolor hover:border-pcolor "
                                    type="text" value={{ Auth::user()->email }} />
                                <textarea name="message" cols="30" rows="10"
                                    class="border mt-3 mb-2 rounded-[4px] p-3 hover:outline-none focus:ring-pcolor focus:border-pcolor hover:border-pcolor"
                                    placeholder="Entrez votre Message"></textarea>
                            </div>
                        @endif
                        <button
                            class="mt-5 w-full border p-2 bg-gradient-to-r from-pcolor bg-black text-white rounded-[4px] hover:bg-stone-600 scale-105 duration-300"
                            type="submit">Envoyer</button>
                    </form>
                </div>
            </div>
        </section>
    </section>
@endsection
