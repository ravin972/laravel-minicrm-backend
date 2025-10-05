@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-3 border-l-4 border-indigo-600 text-start text-base font-medium text-indigo-700 bg-indigo-50/70 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100/80 focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-3 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-indigo-600 hover:bg-gray-50 hover:border-indigo-300 focus:outline-none focus:text-indigo-700 focus:bg-gray-50 focus:border-indigo-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
