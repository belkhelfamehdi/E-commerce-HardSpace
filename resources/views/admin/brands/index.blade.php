<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Marques') }}
        </h2>
    </x-slot>
    <div class="flex flex-col mt-8">


        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            @if ($message = Session::get('success'))
            <div class="session p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">{{ $message }}</span>
              </div>
        @endif
            <div class="flex justify-between mb-3">
                <a href="{{route('admin.brand.create')}}" class="bg-transparent text-sm hover:bg-pcolor py-3 text-pcolor font-semibold hover:text-white px-6 border border-pcolor hover:border-transparent rounded">
                    Ajouter une marque
                </a>
                <input type="search" id="search" class="block w-1/4 py-3 pl-5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-pcolor focus:border-pcolor dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pcolor dark:focus:border-pcolor" placeholder="Marques">
            </div>
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Nom du marque</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Modifier</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Supprimer</th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-white">
                        @foreach ($brands as $brand)
                        <tr>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-500">{{$brand->brand_name}}</div>
                            </td>
    
                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                            <div class="w-fit ml-5">
                                <a href="{{route('admin.brand.edit', $brand->id)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            </div>
                            </td>
                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">

                                <div class="w-fit ml-5">
                                    <form action="{{route('admin.brand.destroy', $brand->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Êtes-vous sûr(e) de vouloir supprimer ce produit ?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-5">{{ $brands->links() }}</div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{url('frontend/assets/vendor/js/jquery-3.6.4.min.js')}}"></script>
    <script>
        $('#search').on('keyup', function(){
            search();
        });
        function search(){
            var keyword = $('#search').val();
            $.post('{{ route("search.category") }}',
            {
                _token: $('meta[name="csrf-token"]').attr('content'),
                keyword:keyword
            },
            function(data){
                table_post_row(data);
                console.log(data);
            });
        }
        // table row with ajax
        function table_post_row(res){
        let htmlView = '';
        if(res.brands.length <= 0){
            htmlView+= `
            <tr>
                <td colspan="4">No data.</td>
            </tr>`;
        }
        for(let i = 0; i < res.brands.length; i++){
            htmlView += `
                <tr>
    
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-500">`+res.brands[i].brand_name+`</div>
                            </td>
    
                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                            <div class="w-fit ml-5">
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            </div>
                            </td>
                            <td
                                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">

                                <div class="w-fit ml-5">
                                    <form action="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Êtes-vous sûr(e) de vouloir supprimer ce produit ?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                `;
        }
            $('tbody').html(htmlView);
        }

        $(document).ready(function() {
            $('.session').css('opacity', 1).delay(1000).animate({opacity: 0}, 1000, function() {
                $(this).css('display', 'none');});
        });
    </script>
</x-admin-layout>