@extends('frontend.layout')

@section('js')
  @vite('resources/js/store.js')
@endsection

@section('content')

    <div class="mt-16 pb-16 text-black bg-scolor dark:bg-dcolor">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>

    @stack('modals')

        @livewireScripts
@endsection