@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-pcolor focus:ring-pcolor rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-200']) !!}>
