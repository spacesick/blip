<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="flex justify-end pt-12 pb-8">
        <livewire:balance-view />
    </div>

    <livewire:ledger-table />
</x-app-layout>
