<x-action-section>
    @section('menu')
    <div class="text-gray-600 dark:text-gray-100 dark:bg-dcolor p-3 h-auto w-auto min-w-fit bg-white shadow-[0px_3px_6px_0px_#f7fafc]">
        <div class="flex m-1 p-1 text-base hover:text-pcolor">
            <a href="{{route('profile.show')}}">Informations de profile</a>
        </div>
        <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="flex m-1 p-1 text-base hover:text-pcolor">
            <a href="{{route('profile.update-password')}}">Mot de passe</a>
        </div>
        <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="flex m-1 p-1 text-base hover:text-pcolor">
            <a href="{{route('orders')}}">Mes commandes</a>
        </div>
        @if (Auth::user()->role == "user")
        <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="flex m-1 p-1 text-base hover:text-pcolor">
            <a href="{{route('supplier.application')}}">Devenir fournisseur</a>
        </div>
        @endif
    </div>
    @endsection>

    <x-slot name="description">
        {{ __('Permanently delete your account.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('Une fois que votre compte sera supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Supprimer le compte') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Supprimer le compte') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Êtes-vous sûr de vouloir supprimer votre compte ? Une fois que votre compte sera supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4"
                                autocomplete="current-password"
                                placeholder="{{ __('Mot de passe') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Annuler') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Supprimer le compte') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
