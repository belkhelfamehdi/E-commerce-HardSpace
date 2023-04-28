@extends('frontend.layout')

  @section('js')
    @vite('resources/js/product.js')
  @endsection
  @section('content')
<div class="px-14 py-10 mt-16 mb-1">
  <ul class="mb-5 font-medium text-sm text-red-700 list-disc list-inside">
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Demande fournisseur</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">Veuillez vous assurez de vos informations avant valider la demande.</p>
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-4">
            <label for="company_name" class="block text-sm font-medium leading-6 text-gray-900">Nom de l'entreprise</label>
            <div class="mt-2">
              <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-pcolor sm:max-w-md">
                <input type="text" name="company_name" value="{{$application->company_name}}" id="company_name" autocomplete="username" class="block flex-1 pl-5 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Nom de l'entreprise" disabled>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Informations de l'entreprise</h2>
        <p class="mt-1 mb-6 text-sm leading-6 text-gray-600">Veuillez vous assurez de vos informations avant valider la demande.</p>
  
          <div class="sm:col-span-4">
            <label for="company_email" class="block text-sm font-medium leading-6 text-gray-900">Email de l'entreprise</label>
            <div class="mt-2">
              <input id="company_email" value="{{$application->company_email}}" name="company_email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pcolor sm:text-sm sm:leading-6" disabled>
            </div>
          </div>

          <div class="sm:col-span-4 py-2">
            <label for="company_number" class="block text-sm font-medium leading-6 text-gray-900">Numéro de l'entreprise</label>
            <div class="mt-2">
              <input id="company_number" name="company_number" value="{{$application->company_number}}" type="tel" autocomplete="tel" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pcolor sm:text-sm sm:leading-6" disabled>
            </div>
          </div>
  
          <div class="sm:col-span-3 py-2">
            <label for="company_country" class="block text-sm font-medium leading-6 text-gray-900">Pays</label>
            <div class="mt-2">
              <select id="company_country" name="company_country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-pcolor sm:max-w-xs sm:text-sm sm:leading-6" disabled>
                <option>{{$application->company_country}}</option>
              </select>
            </div>
          </div>
  
          <div class="col-span-full py-2">
            <label for="company_street" class="block text-sm font-medium leading-6 text-gray-900">Rue</label>
            <div class="mt-2">
              <input type="text" name="company_street" value="{{$application->company_street}}" id="company_street" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pcolor sm:text-sm sm:leading-6" disabled>
            </div>
          </div>
  
          <div class="sm:col-span-2 sm:col-start-1 py-2">
            <label for="company_city" class="block text-sm font-medium leading-6 text-gray-900">Ville</label>
            <div class="mt-2">
              <input type="text" name="company_city" id="company_city" value="{{$application->company_city}}" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pcolor sm:text-sm sm:leading-6" disabled>
            </div>
          </div>
  
          <div class="sm:col-span-2 py-2">
            <label for="company_state" class="block text-sm font-medium leading-6 text-gray-900">Etat / Province</label>
            <div class="mt-2">
              <input type="text" name="company_state" id="company_state" value="{{$application->company_state}}" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pcolor sm:text-sm sm:leading-6" disabled>
            </div>
          </div>
  
          <div class="sm:col-span-2 py-2">
            <label for="company_zip" class="block text-sm font-medium leading-6 text-gray-900">ZIP / Code postale</label>
            <div class="mt-2">
              <input type="text" name="company_zip" value="{{$application->company_zip}}" id="company_zip" autocomplete="postal-code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pcolor sm:text-sm sm:leading-6" disabled>
            </div>
          </div>
        </div>
        <div class="pb-6">
            <div class="col-span-full">
              <label for="message" class="block text-sm font-medium leading-6 text-gray-900">Message</label>
              <div class="mt-2">
                <textarea id="message" name="message" rows="8" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pcolor sm:text-sm sm:leading-6" disabled>value="{{$application->message}}"</textarea>
              </div>
            </div>
          </div>
          <div class="flex justify-end w-full">
            <form action="{{route('admin.applications.reject', $application->id) }}" method="POST">
                @csrf
                @method('PUT')
              <div class="mx-1 flex items-center justify-end gap-x-6">
                <button onclick="return confirm('Êtes-vous sûr(e) de vouloir rejeter la demande ?')" type="submit" class="rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">Rejeter</button>
              </div>
            </form>
          <form action="{{route('admin.applications.accept', $application->id) }}" method="POST">
            @csrf
            @method('PUT')
          <div class="mx-1 flex items-center justify-end gap-x-6">
            <button onclick="return confirm('Êtes-vous sûr(e) de vouloir accepter la demande ?')" type="submit" class="rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500">Accepter</button>
          </div>
        </form>
        </div>
      </div>

</div>
  @endsection