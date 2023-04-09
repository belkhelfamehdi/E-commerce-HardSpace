<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <div class="flex flex-col mt-8">


        <div class="py-2 -my-2 overflow-x-auto ">
            <div class="inline-block p-4 bg-white min-w-full overflow-hidden align-middle border border-gray-200 shadow sm:rounded-lg">

                <ul class="mb-5 font-medium text-sm text-red-700 list-disc list-inside">
                    @error('product_name')
                        <li>{{ $message }}</li>
                    @enderror
                    @error('product_code')
                    <li>{{ $message }}</li>
                    @enderror 
                    @error('price')
                    <li>{{ $message }}</li>
                    @enderror 
                    @error('product_qty')
                    <li>{{ $message }}</li>
                    @enderror 
                    @error('image')
                    <li>{{ $message }}</li>
                    @enderror 
                    @error('description')
                    <li>{{ $message }}</li>
                    @enderror 
                </ul>
               
                <form method="post" action="{{route('admin.products.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom du produit</label>
                            <input type="text" name="product_name" id="product_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pcolor focus:border-pcolor block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pcolor dark:focus:border-pcolor" placeholder="Nom du produit" required>
                        </div>
                        <div>
                            <label for="product_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ref</label>
                            <input type="text" name="product_code" id="product_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pcolor focus:border-pcolor block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pcolor dark:focus:border-pcolor" placeholder="Référence" required>
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix du produit</label>
                            <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pcolor focus:border-pcolr block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pcolor dark:focus:border-pcolor" placeholder="DZD" required>
                        </div>
                        <div>
                            <label for="product_qty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantité</label>
                            <input type="number" name="product_qty" id="product_qty" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pcolor focus:border-pcolor block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pcolor dark:focus:border-pcolor" placeholder="" required>
                        </div>
                        <div>
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Catégories</label>
                            <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pcolor focus:border-pcolor block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pcolor dark:focus:border-pcolor">
                              <option selected>Choisissez la catégorie:</option>
                              <option value="US">United States</option>
                              <option value="CA">Canada</option>
                              <option value="FR">France</option>
                              <option value="DE">Germany</option>
                            </select>
                        </div>
                        <div>
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Marques</label>
                            <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pcolor focus:border-pcolor block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pcolor dark:focus:border-pcolor">
                              <option selected>Choisissez la marque:</option>
                              <option value="US">United States</option>
                              <option value="CA">Canada</option>
                              <option value="FR">France</option>
                              <option value="DE">Germany</option>
                            </select>
                        </div>
                        <div>
                            
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Image</label>
                            <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="image" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or WEBP.</p>

                        </div>
                        <div class="col-span-2 w-full">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-pcolor focus:border-pcolor dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pcolor dark:focus:border-pcolor" placeholder="Écrivez votre description ici..."></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="text-white bg-pcolor focus:ring-4 focus:outline-none focus:ring-pcolor font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-pcolor dark:hover:bg-pcolor dark:focus:ring-pcolor">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-admin-layout>