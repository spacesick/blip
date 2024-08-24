<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Transaction Details') }}
        </h2>
    </x-slot>

    <div class="flex flex-col py-12 gap-4">
        <div>
            <div class="font-mono text-2xl text-neutral-900">
                {{ $transaction->code }}
            </div>
            <div class="font-bold text-lg text-neutral-900">
                {{ $transaction->entry }}
            </div>
        </div>
        <div>
            <label class="block font-medium text-sm text-neutral-700">
                Amount
            </label>
            <div class="px-4 font-mono font-bold text-lg text-neutral-900">
                {{ $transaction->amount }}
            </div>
        </div>
        <div>
            <label class="block font-medium text-sm text-neutral-700">
                Details
            </label>
            <p class="px-4 font-normal text-neutral-900">
                {{ $transaction->details }}
            </p>
        </div>
        @if($image)
            @if($transaction->entry === 'debit')
                <label class="block font-medium text-sm text-neutral-700">
                    Attachment
                </label>
            @elseif($transaction->entry === 'credit')
                <label class="block font-medium text-sm text-neutral-700">
                    Proof
                </label>
            @endif
            <div class="mb-2">
                <img src="{{ $image }}" alt="attachment">
            </div>
        @endif
    </div>
</x-app-layout>
