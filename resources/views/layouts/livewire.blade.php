<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ $headertitle }}
        </h2>
    </x-slot>
    {{ $slot }}
</x-app-layout>
