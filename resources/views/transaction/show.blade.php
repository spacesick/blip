<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Transaction Details') }}
        </h2>
    </x-slot>

    <div class="flex flex-col py-10 gap-6">
        <div>
            <div class="font-mono font-bold text-2xl text-neutral-900">
                {{ $transaction->code }}
            </div>
            <div class="font-mono font-bold text-xl text-neutral-900">
                {{ Str::ucfirst($transaction->entry) }}
            </div>
        </div>
        <div>
            <label class="block font-medium text-sm text-neutral-700">
                Amount
            </label>
            <div class="font-mono text-xl text-neutral-900">
                {{ 'Rp.'.number_format($transaction->amount, 2, ',', '.') }}
            </div>
        </div>
        <div>
            <label class="block font-medium text-sm text-neutral-700">
                Details
            </label>
            <p class="text-neutral-950">
                {{ $transaction->details }}
            </p>
        </div>
        @if($image)
            <div>
                @if($transaction->entry === 'debit')
                    <label class="block font-medium text-sm text-neutral-700">
                        Attachment
                    </label>
                @elseif($transaction->entry === 'credit')
                    <label class="block font-medium text-sm text-neutral-700">
                        Proof
                    </label>
                @endif
                <div class="mb-2 pt-2">
                    <img src="{{ $image }}" alt="attachment">
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
