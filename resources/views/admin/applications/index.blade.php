<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Demandes') }}
        </h2>
    </x-slot>
    <div class="flex flex-col mt-8">


        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            @if ($message = Session::get('success'))
            <div class="session p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">{{ $message }}</span>
              </div>
        @endif
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Numero de la demande</th>
                                <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Nom</th>
                                <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Prénom</th>
                                <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Date de la demande</th>
                                <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Consulter</th>
                                <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Modifier</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Supprimer</th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-white">
                        @foreach ($applications as $application)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-500">{{$application->user_id}}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-500">{{\App\Models\User::where('id', $application->user_id)->first()->LastName}}</div>
                            </td>
    
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-500">{{\App\Models\User::where('id', $application->user_id)->first()->FirstName}}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-500">{{$application->created_at}}</div>
                            </td>
                            <td
                            class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                        <div class="w-fit ml-5">
                            <a href="{{route('admin.applications.show', $application->id)}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>
                        </div>
                        </td>
                            <td
                            class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                        <div class="w-fit ml-5">
                            <form action="{{route('admin.applications.accept', $application->id) }}" method="POST">
                            <button onclick="return confirm('Êtes-vous sûr(e) de vouloir accepter la demande ?')">
                                @csrf
                                @method('PUT')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                </button>
                            </form>
                        </div>
                        </td>
                        <td
                            class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">

                            <div class="w-fit ml-5">
                                <form action="{{route('admin.applications.reject', $application->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button onclick="return confirm('Êtes-vous sûr(e) de vouloir rejeter la demande ?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                          </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-5">{{ $applications->links() }}</div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{url('frontend/assets/vendor/js/jquery-3.6.4.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.session').css('opacity', 1).delay(1000).animate({opacity: 0}, 1000, function() {
                $(this).css('display', 'none');});
        });
    </script>
</x-admin-layout>