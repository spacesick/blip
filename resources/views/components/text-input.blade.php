@props([
    'disabled' => false,
    'tail' => null
])

<div class="flex">
    @if ($slot->hasActualContent())
        <div {!! $attributes->class(['h-10 text-neutral-400 fill-neutral-400 border-l border-y bg-primary-100 border-neutral-200 focus:border-neutral-400 focus:ring-primary-100 rounded-l-md transition content-center cursor-default font-medium text-sm']) !!}>
            {{ $slot }}
        </div>
    @endif

    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->class(['rounded-md' => $slot->isEmpty(), 'rounded-r-md' => $slot->isNotEmpty() && !$tail, 'rounded-l-md' => !!$tail && $slot->isEmpty()])->merge(['class' => 'h-10 bg-primary-50 border-neutral-200 focus:border-neutral-400 focus:ring-primary-100 transition placeholder-primary-300']) !!}>

    @if ($tail)
        <div {!! $attributes->class(['h-10 flex justify-center place-items-center w-10 text-neutral-400 fill-neutral-400 border-r border-y bg-primary-100 border-neutral-200 focus:border-neutral-400 focus:ring-primary-100 rounded-r-md transition content-center cursor-default font-medium text-sm']) !!}>
            {{ $tail }}
        </div>
    @endif
</div>
