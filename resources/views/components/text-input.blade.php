@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'h-10 bg-primary-50 border-neutral-300 focus:border-neutral-400 focus:ring-primary-100 rounded-md']) !!}>
