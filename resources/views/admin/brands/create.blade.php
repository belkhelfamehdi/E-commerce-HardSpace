<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Marques') }}
        </h2>
    </x-slot>
    <div class="flex flex-col mt-8">


        <div class="py-2 -my-2 overflow-x-auto ">
            <div class="inline-block p-4 bg-white min-w-full overflow-hidden align-middle border border-gray-200 shadow sm:rounded-lg">

                <ul class="mb-5 font-medium text-sm text-red-700 list-disc list-inside">
                    @error('brand_name')
                        <li>{{ $message }}</li>
                    @enderror
                </ul>
                <form method="post" action="{{route('admin.brand.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="category_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom du marque</label>
                            <input type="text" name="brand_name" id="category_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pcolor focus:border-pcolor block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pcolor dark:focus:border-pcolor" placeholder="Nom du categorie">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="text-white bg-pcolor focus:ring-4 focus:outline-none focus:ring-pcolor font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-pcolor dark:hover:bg-pcolor dark:focus:ring-pcolor">Ajouter</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-admin-layout>