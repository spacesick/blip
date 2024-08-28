@assets
<script src="https://js.xendit.co/v1/xendit.min.js"></script>
@endassets

@script
<script>
    Xendit.setPublishableKey("{{ config('xendit.pub_key') }}");

    $wire.on('create-token', () => {
        Xendit.card.createToken({
            amount: Number($wire.form.amount),
            card_number: $wire.form.card_number,
            card_holder_name: $wire.form.card_name,
            card_exp_month: $wire.form.card_exp_month,
            card_exp_year: $wire.form.card_exp_year,
            card_cvn: $wire.form.card_cvv,
            is_multiple_use: false,
            should_authenticate: true,
        }, (err, token) => {
            if (err) {
                $wire.tokenizationError(err);
            }

            if (token.status === 'APPROVED' || token.status === 'VERIFIED') {
                $wire.dispatch('close-modal', 'request-secure-auth');
                $wire.dispatchSelf('charge', {
                    tokenId: token.id,
                    tokenAuth: token.authentication_id,
                });
            }
            else if (token.status === 'IN_REVIEW') {
                window.open(token.payer_authentication_url, 'secure-frame');
                $wire.dispatch('open-modal', 'request-secure-auth');
            }
            else {
                $wire.tokenizationError(token);
            }
        });
    });
</script>
@endscript

<x-slot:headertitle>
    {{ __('Top Up with Credit Card') }}
</x-slot:headertitle>

<div class="py-12 px-24">

    <div class="border border-neutral-200 rounded-md text-sm p-12">
        <form wire:submit="save" method="POST" enctype="multipart/form-data" action="{{ route('transfer-c') }}" class="flex flex-col gap-2">
            @csrf
            <input type="hidden" wire:model="form.idempotent_key" name="idempotent_key">
            <!-- Amount -->
            <div>
                <x-input-label for="amount" :value="__('Amount')" />

                <x-text-input id="amount" class="block my-2"
                              wire:model="form.amount"
                              name="amount"
                              placeholder="25000"
                              required autofocus autocomplete="current-amount">
                    <div class="flex justify-center w-10">
                        Rp.
                    </div>
                    <x-slot:tail>
                        .00
                    </x-slot:tail>
                </x-text-input>

                <x-input-error :messages="$errors->get('form.amount')" />
            </div>

            <!-- Details -->
            <div>
                <x-input-label for="details" :value="__('Details')" />

                <x-text-area id="details" class="block my-2 w-full"
                             wire:model="form.details"
                             type="text"
                             rows="4"
                             name="details" />

                <x-input-error :messages="$errors->get('form.details')" />
            </div>

            <!-- Proof -->
            <div>
                <x-input-label for="image_attachment" :value="__('Proof')" />

                <input id="image_attachment" class="my-2" wire:model="form.image_attachment" type="file" name="image_attachment">

                <x-input-error :messages="$errors->get('form.image_attachment')" />
            </div>

            <!-- Credit Card Details -->
            <div class="flex justify-between">
                <div class="w-full">
                    <x-input-label for="card_number" :value="__('Card Number')" />

                    <x-text-input id="card_number" class="block my-2 w-44"
                                  wire:model="form.card_number"
                                  name="card_number"
                                  required autofocus autocomplete="current-card_number" />

                    <x-input-error :messages="$errors->get('form.card_number')" />
                </div>
                <div class="flex w-full justify-between">
                    <div class="w-full">
                        <x-input-label :value="__('Expiry Date')" />
                        <div class="flex">
                                <x-text-input id="card_exp_month" class="block my-2 w-12 rounded-r-none"
                                              wire:model="form.card_exp_month"
                                              placeholder="MM"
                                              name="card_exp_month"
                                              required autofocus autocomplete="current-card_exp_month" />

                                <x-text-input id="card_exp_year" class="block my-2 w-16 rounded-l-none"
                                              wire:model="form.card_exp_year"
                                              placeholder="YYYY"
                                              name="card_exp_year"
                                              required autofocus autocomplete="current-card_exp_year" />
                        </div>

                        <x-input-error :messages="$errors->get('form.card_exp_month')" />

                        <x-input-error :messages="$errors->get('form.card_exp_year')" />
                    </div>

                    <div class="w-full">
                        <x-input-label for="card_cvv" :value="__('CVV')" />

                        <x-text-input id="card_cvv" class="block my-2 w-16"
                                      wire:model="form.card_cvv"
                                      name="card_cvv"
                                      required autofocus autocomplete="current-card_cvv" />

                        <x-input-error :messages="$errors->get('form.card_cvv')" />
                    </div>
                </div>
            </div>
            <div>
                <x-input-label for="card_name" :value="__('Card Name')" />

                <x-text-input id="card_name" class="block my-2 w-64"
                              wire:model="form.card_name"
                              name="card_name"
                              required autofocus autocomplete="current-card_name" />

                <x-input-error :messages="$errors->get('form.card_name')" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-3">
                    <div class="px-4 py-2">
                        {{ __('Submit') }}
                    </div>
                </x-primary-button>
            </div>
        </form>
    </div>

    <x-modal name="request-secure-auth" :show="false" max-width="4xl" :has-to-complete="true" :fill-height="true">
        <div class="bg-white rounded-lg p-8 h-full flex flex-col">
            <h2 class="text-lg font-semibold text-neutral-900">
                {{ __('Secure Authentication Required') }}
            </h2>

            <p class="mt-2 text-neutral-700">
                {{ __('Please authenticate your transaction in the secure frame below.') }}
            </p>

            <iframe id="secure-frame" name="secure-frame" src="" class="w-full mt-6 grow"></iframe>
        </div>
    </x-modal>
</div>
