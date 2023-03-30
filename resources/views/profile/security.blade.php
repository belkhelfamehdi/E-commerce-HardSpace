@extends('frontend.layout')

@section('js')
  @vite('resources/js/store.js')
@endsection

@section('content')
<div class="mt-16 py-16 text-black bg-scolor">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        <div class="mt-10 sm:mt-0">
            @livewire('profile.two-factor-authentication-form')
        </div>

        <x-section-border />
    @endif

    <div class="mt-10 sm:mt-0">
        @livewire('profile.logout-other-browser-sessions-form')
    </div>
    </div>
</div>

@stack('modals')

@livewireScripts
@endsection