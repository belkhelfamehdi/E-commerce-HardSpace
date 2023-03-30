@extends('frontend.layout')

@section('js')
  @vite('resources/js/store.js')
@endsection

@section('content')
<div class="mt-16 py-16 text-black bg-scolor">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="mt-10 sm:mt-0">
            @livewire('profile.update-password-form')
        </div>
    </div>
</div>
@endif

@stack('modals')

@livewireScripts
@endsection