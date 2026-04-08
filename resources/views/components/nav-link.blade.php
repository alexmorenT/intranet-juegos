@props(['active'])

@php
$classes = ($active ?? false)
? 'flex items-center px-4 py-3 border-l-4 border-indigo-500 text-sm font-medium text-indigo-700 bg-indigo-50 focus:outline-none transition'
: 'flex items-center px-4 py-3 border-l-4 border-transparent text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 focus:outline-none transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>