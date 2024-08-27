@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'min-h-10 bg-primary-50 border-neutral-200 focus:border-neutral-400 focus:ring-primary-100 rounded-md transition']) !!}></textarea>
