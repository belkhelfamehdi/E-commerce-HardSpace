<x-form-section submit="updatePassword">
    @section('menu')
    <div class="text-gray-600 dark:text-gray-100 dark:bg-dcolor p-3 h-auto w-auto min-w-fit bg-white shadow-[0px_3px_6px_0px_#f7fafc]">
        <div class="flex m-1 p-1 text-base hover:text-pcolor">
            <a href="{{route('profile.show')}}">Informations de profile</a>
        </div>
        <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="flex m-1 p-1 text-base font-bold text-pcolor">
            <a href="{{route('profile.update-password')}}">Mot de passe</a>
        </div>
        <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="flex m-1 p-1 text-base hover:text-pcolor">
            <a href="{{route('profile.security')}}">Sécurité</a>
        </div>
        <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="flex m-1 p-1 text-base hover:text-pcolor">
            <a href="{{ route('profile.delete-profile') }}">Supprimer le compte</a>
        </div>
    </div>
    @endsection

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('Current Password') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('New Password') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
