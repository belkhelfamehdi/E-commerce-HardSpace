<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <div class="flex flex-col opacity-0 pointer-events-none">
        @yield('menu')
    </div>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
            {{ $content }}
        </div>
    </div>
</div>