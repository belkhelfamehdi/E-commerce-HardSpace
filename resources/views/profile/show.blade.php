@extends('frontend.layout')

@section('js')
  @vite('resources/js/store.js')
@endsection

@section('content')

    <div class="mt-16 py-16 text-black bg-scolor dark:bg-dcolor">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
            @endif
        </div>
    </div>

    @stack('modals')

        @livewireScripts
@endsection