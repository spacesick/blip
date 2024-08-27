@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-accent-400 text-sm font-medium leading-5 text-primary-900 focus:outline-none focus:border-accent-700 transition'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-primary-500 hover:text-primary-700 hover:border-primary-300 focus:outline-none focus:text-primary-700 focus:border-primary-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
