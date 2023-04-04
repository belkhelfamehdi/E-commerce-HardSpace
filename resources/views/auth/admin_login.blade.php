<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('backend') }}/images/favicon.ico">

    <title>Sunny Admin - Log in </title>
  
	@vite('resources/css/app.css')

</head>
<body class="hold-transition theme-primary bg-gradient-primary">
	
	<div class="container w-1/2 mt-28  mx-auto p-4 bg-white shadow-[rgba(50,_50,_105,_0.15)_0px_2px_5px_0px,_rgba(0,_0,_0,_0.05)_0px_1px_1px_0px]">
		<div class="w-full md:w-1/2 lg:w-4/5 mx-auto my-12 ">
		  <h1 class="text-lg font-bold">Admin</h1>
		  <form class="flex flex-col mt-4" method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}">
			@csrf
			<ul class="mb-5 font-medium text-sm text-red-700 list-disc list-inside">
				@error('email')
					<li>{{ $message }}</li>
				@enderror
				@error('password')
				<li>{{ $message }}</li>
				@enderror 
			</ul>
			<input
				type="email"
				name="email"
				class="px-4 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm"
				placeholder="Email"
			/>
			<input
				type="password"
				name="password"
				class="px-4 py-3 mt-4 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm"
				placeholder="Mot de passe"
			/>
			<div class="block mt-4">
				<label for="remember_me" class="flex items-center">
					<x-checkbox id="remember_me" name="remember" />
					<span class="ml-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
				</label>
			</div>
			<button
				type="submit"
				class="mt-4 px-4 py-3  leading-6 text-base rounded-md border border-transparent text-white focus:outline-none bg-pcolor text-white focus:ring-2 focus:ring-pcolor focus:ring-offset-2 cursor-pointer inline-flex items-center w-full justify-center items-center font-medium focus:outline-none"
			>
			  Login
			</button>
	
		  </form>
		</div>
	  </div>

</body>
</html>

