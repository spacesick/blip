<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('New Debit Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12 px-24">

        <div class="border border-neutral-200 rounded-md text-sm p-12">
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ $request->session()->get('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        - {{ $error }}<br />
                    @endforeach
                </div>
            @endif

            <form method="POST" enctype="multipart/form-data" action="{{ route('transfer-d') }}" class="flex flex-col gap-2">
                @csrf
                <input type="hidden" name="idempotent_key" value="{{ (string) Str::uuid() }}">
                <!-- Amount -->
                <div>
                    <x-input-label for="amount" :value="__('Amount')" />

                    <x-text-input id="amount" class="block my-2"
                                  type="text"
                                  name="amount"
                                  required autofocus autocomplete="current-amount" />

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

                <!-- Attachment -->
                <div>
                    <x-input-label for="image_attachment" :value="__('Attachment')" />

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
