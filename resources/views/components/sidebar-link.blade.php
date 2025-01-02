@props(['active'])

@php
    $classes = ($active ?? false)
        ? 'flex items-center space-x-3 p-2 rounded-md font-medium text-gray-700 bg-gray-200 hover:bg-gray-200 focus:bg-gray-200 focus:shadow-outline'
        : 'flex items-center space-x-3 p-2 rounded-md font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:bg-gray-200 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>