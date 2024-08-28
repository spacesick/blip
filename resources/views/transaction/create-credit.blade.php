<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('New Credit Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12 px-24">

        <div class="border border-neutral-200 rounded-md text-sm p-12">
            <form method="POST" enctype="multipart/form-data" action="{{ route('transfer-c') }}" class="flex flex-col gap-2">
                @csrf
                <x-input-error :messages="$errors->get('flow_error')" />

                <input type="hidden" name="idempotent_key" value="{{ (string) Str::uuid() }}">
                <!-- Amount -->
                <div>
                    <x-input-label for="amount" :value="__('Amount')" />

                    <x-text-input id="amount" class="block my-2"
                                  name="amount"
                                  placeholder="25000.50"
                                  required autofocus autocomplete="current-amount">
                        <div class="flex justify-center w-10">
                            Rp.
                        </div>
                    </x-text-input>

                    <x-input-error :messages="$errors->get('amount')" />
                </div>

                <!-- Details -->
                <div>
                    <x-input-label for="details" :value="__('Details')" />

                    <x-text-area id="details" class="block my-2 w-full"
                                 type="text"
                                 rows="4"
                                 name="details" />

                    <x-input-error :messages="$errors->get('details')" />
                </div>

                <!-- Proof -->
                <div>
                    <x-input-label for="image_attachment" :value="__('Proof')" />

                    <input id="image_attachment" class="my-2" type="file" name="image_attachment">

                    <x-input-error :messages="$errors->get('image_attachment')" />
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
    </div>
</x-app-layout>
