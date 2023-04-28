<x-form-section submit="updateProfileInformation">
    @section('menu')
    <div class="text-gray-600 dark:text-gray-100 dark:bg-dcolor p-3 h-auto w-auto min-w-fit bg-white shadow-[0px_3px_6px_0px_#f7fafc]">
        <div class="flex m-1 p-1 text-base font-bold text-pcolor">
            <a href="{{route('profile.show')}}">Informations de profile</a>
        </div>
        <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="flex m-1 p-1 text-base hover:text-pcolor">
            <a href="{{route('profile.update-password')}}">Mot de passe</a>
        </div>
        <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="flex m-1 p-1 text-base hover:text-pcolor">
            <a href="">Mes commandes</a>
        </div>
        @if (Auth::user()->role == "user")
        <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
        <div class="flex m-1 p-1 text-base hover:text-pcolor">
            <a href="{{route('supplier.application')}}">Devenir fournisseur</a>
        </div>
        @endif
    </div>
    @endsection

    <x-slot name="form">
        
        <x-action-message class="mr-3 w-full col-span-2" on="saved">
            <div class="p-4 mb-2 text-sm text-green-800 dark:text-green-400 rounded-lg bg-green-100 dark:bg-green-800 dark:text-green-400">
                <span>{{ __('Les modifications ont été enregistrées avec succès.') }}</span>
              </div>
        </x-action-message>

        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ Storage::url($this->user->profile_photo_path) }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- First Name -->
        <div class="w-auto">
            <x-label for="FirstName" value="{{ __('Prénom') }}" />
            <x-input id="FirstName" type="text" class="mt-1 w-full" wire:model.defer="state.FirstName" autocomplete="FirstName" />
            <x-input-error for="FirstName" class="mt-2" />
        </div>
                <!-- Last Name -->
        <div class="w-auto">
            <x-label for="LastName" value="{{ __('Nom') }}" />
            <x-input id="LastName" type="text" class="mt-1 w-full" wire:model.defer="state.LastName" autocomplete="LastName" />
            <x-input-error for="LastName" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="w-auto">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 w-full" wire:model.defer="state.email" autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            
        </div>

        <div class="w-auto">
            <x-label for="phone_number" value="{{ __('Numéro de téléphone') }}" />
            <x-input id="phone_number" type="text" class="mt-1 w-full" wire:model.defer="state.phone_number" autocomplete="phone_number" />
            <x-input-error for="phone_number" class="mt-2" />
        </div>
        <div class="w-full col-span-4">
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 dark:text-gray-200">
                    {{ __("Votre adresse e-mail n'est pas vérifiée.") }}

                    <button type="button" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-pcolor rounded-md focus:outline-none" wire:click.prevent="sendEmailVerification">
                        {{ __("Cliquez ici pour renvoyer l'e-mail de vérification.") }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">


        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Enregistrer') }}
        </x-button>
    </x-slot>
</x-form-section>
