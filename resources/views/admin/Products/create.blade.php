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
                    @error('images')
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
                            <input type="text" name="product_name" id="product_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pcolor focus:border-pcolor block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pcolor dark:focus:border-pcolor" placeholder="Nom du produit">
                        </div>
                        <div>
                            <label for="product_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ref</label>
                            <input type="text" name="product_code" id="product_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pcolor focus:border-pcolor block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pcolor dark:focus:border-pcolor" placeholder="Référence">
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix du produit</label>
                            <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pcolor focus:border-pcolr block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pcolor dark:focus:border-pcolor" placeholder="DZD">
                        </div>
                        <div>
                            <label for="product_qty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantité</label>
                            <input type="number" name="product_qty" id="product_qty" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pcolor focus:border-pcolor block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pcolor dark:focus:border-pcolor" placeholder="">
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
                        <div class="col-span-2 w-full">
                            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                            </div>
                        <div>
                            
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Image</label>
                            <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="image" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or WEBP.</p>

                        </div>
                        <div class="col-span-2 w-full">
                            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                        </div>

                        <!-- component -->
                        <div class="col-span-2 w-full h-fit">
                            <main class="mx-auto max-w-screen-lg">
                            <article aria-label="File Upload Modal" class="relative p-3 h-full flex flex-col bg-white shadow-lg rounded-md" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);" ondragleave="dragLeaveHandler(event);" ondragenter="dragEnterHandler(event);">
                                <div id="overlay" class="w-full h-full absolute top-0 left-0 pointer-events-none z-50 flex flex-col items-center justify-center rounded-md">
                                <i>
                                    <svg class="fill-current w-12 h-12 mb-3 text-pcolor" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M19.479 10.092c-.212-3.951-3.473-7.092-7.479-7.092-4.005 0-7.267 3.141-7.479 7.092-2.57.463-4.521 2.706-4.521 5.408 0 3.037 2.463 5.5 5.5 5.5h13c3.037 0 5.5-2.463 5.5-5.5 0-2.702-1.951-4.945-4.521-5.408zm-7.479-1.092l4 4h-3v4h-2v-4h-3l4-4z" />
                                    </svg>
                                </i>
                                <p class="text-lg text-pcolor">Drop files to upload</p>
                                </div>

                                <!-- scroll area -->
                                <section class="h-[80vh] w-full flex flex-col">
                                <header class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
                                    <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                                    <span>Faites glisser</span>&nbsp;<span>vos fichiers n'importe où</span>
                                    </p>
                                    <input id="hidden-input" name="images[]" type="file" multiple onchange="limitFiles(this)" class="hidden" />
                                    <a id="button" class="mt-2 cursor-pointer rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                                        Sélectionnez une image
                                    </a>
                                </header>

                                <h1 class="pt-8 pb-3 font-semibold sm:text-lg text-gray-900">
                                    Images Sélectionné
                                </h1>

                                <ul id="gallery" class="flex flex-1 flex-wrap -m-1">
                                    <li id="empty" class="h-full w-full text-center flex flex-col items-center justify-center items-center">
                                    <img class="mx-auto w-32" src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png" alt="no data" />
                                    <span class="text-small text-gray-500">Aucun fichier sélectionné</span>
                                    </li>
                                </ul>
                                </section>
                            </article>
                            </main>
                            </div>

                            <template id="image-template">
                                    <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
                                    <article tabindex="0" class="group hasImage w-fit h-fit py-5 rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                                        <img alt="upload preview" class="img-preview w-fit h-fit sticky object-cover rounded-md bg-fixed" />

                                        <section class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                                        <h1 class="flex-1"></h1>
                                        <div class="flex">
                                            <span class="p-1">
                                            <i>
                                                <svg class="fill-current w-4 h-4 ml-auto pt-" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                                                </svg>
                                            </i>
                                            </span>

                                            <p class="p-1 size text-xs"></p>
                                            <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md">
                                            <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path class="pointer-events-none" d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                                            </svg>
                                            </button>
                                        </div>
                                        </section>
                                    </article>
                                    </li>
                                </template>

                        <div class="col-span-2 w-full">
                            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
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
    <script>
        const fileTempl = document.getElementById("file-template"),
        imageTempl = document.getElementById("image-template"),
        empty = document.getElementById("empty");
        const button = document.querySelector('#button');


        button.addEventListener('click', (event) => {
        event.preventDefault();
        });

        let FILES = {};
        
        function addFile(target, file) {
        const isImage = file.type.match("image.*"),
          objectURL = URL.createObjectURL(file);
        
        const clone = isImage
          ? imageTempl.content.cloneNode(true)
          : fileTempl.content.cloneNode(true);
        
        clone.querySelector("h1").textContent = file.name;
        clone.querySelector("li").id = objectURL;
        clone.querySelector(".delete").dataset.target = objectURL;
        clone.querySelector(".size").textContent =
          file.size > 1024
            ? file.size > 1048576
              ? Math.round(file.size / 1048576) + "mb"
              : Math.round(file.size / 1024) + "kb"
            : file.size + "b";
        
        isImage &&
          Object.assign(clone.querySelector("img"), {
            src: objectURL,
            alt: file.name
          });
        
        empty.classList.add("hidden");
        target.prepend(clone);
        
        FILES[objectURL] = file;
        }
        
        const gallery = document.getElementById("gallery"),
        overlay = document.getElementById("overlay");
        
        // click the hidden input of type file if the visible button is clicked
        // and capture the selected files
        const hidden = document.getElementById("hidden-input");
        document.getElementById("button").onclick = () => hidden.click();
        hidden.onchange = (e) => {
        for (const file of e.target.files) {
          addFile(gallery, file);
        }
        };
        
        // use to check if a file is being dragged
        const hasFiles = ({ dataTransfer: { types = [] } }) =>
        types.indexOf("Files") > -1;
        
        // use to drag dragenter and dragleave events.
        // this is to know if the outermost parent is dragged over
        // without issues due to drag events on its children
        let counter = 0;
        
        // reset counter and append file to gallery when file is dropped
        function dropHandler(ev) {
        ev.preventDefault();
        for (const file of ev.dataTransfer.files) {
          addFile(gallery, file);
          overlay.classList.remove("draggedover");
          counter = 0;
        }
        }
        
        // only react to actual files being dragged
        function dragEnterHandler(e) {
        e.preventDefault();
        if (!hasFiles(e)) {
          return;
        }
        ++counter && overlay.classList.add("draggedover");
        }
        
        function dragLeaveHandler(e) {
        1 > --counter && overlay.classList.remove("draggedover");
        }
        
        function dragOverHandler(e) {
        if (hasFiles(e)) {
          e.preventDefault();
        }
        }
        
        // event delegation to caputre delete events
        // fron the waste buckets in the file preview cards
        gallery.onclick = ({ target }) => {
        if (target.classList.contains("delete")) {
          const ou = target.dataset.target;
          document.getElementById(ou).remove(ou);
          gallery.children.length === 1 && empty.classList.remove("hidden");
          delete FILES[ou];
        }
        };

        function limitFiles(input) {
        if (input.files.length > 3) {
          input.value = "";
          alert("You can only upload up to three images.");
        }
      }
    </script>
</x-admin-layout>