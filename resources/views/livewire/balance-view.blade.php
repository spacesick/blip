<section>
    <div class="flex border border-neutral-200 rounded-md text-sm px-4 py-3 min-w-48">
        <div>
            <label class="block font-medium text-sm text-neutral-700">
                Balance
            </label>
            @if($balance)
                <h3 class="text-2xl font-mono">
                    {{ $balance }}
                </h3>
            @else
                <h3 class="text-2xl font-mono">
                    ••••••••
                </h3>
            @endif
        </div>
        @if(!$balance)
            <div class="grow flex justify-end place-items-center">
                <div wire:click="fetchBalance" class="fill-neutral-600 p-2 align-center items-center rounded-md font-semibold text-xs text-gray-700 hover:bg-primary-200 focus:outline-none focus:bg-primary-200 transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" ><path d="M15.5 12a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"></path><path d="M12 3.5c3.432 0 6.124 1.534 8.054 3.241 1.926 1.703 3.132 3.61 3.616 4.46a1.6 1.6 0 0 1 0 1.598c-.484.85-1.69 2.757-3.616 4.461-1.929 1.706-4.622 3.24-8.054 3.24-3.432 0-6.124-1.534-8.054-3.24C2.02 15.558.814 13.65.33 12.8a1.6 1.6 0 0 1 0-1.598c.484-.85 1.69-2.757 3.616-4.462C5.875 5.034 8.568 3.5 12 3.5ZM1.633 11.945a.115.115 0 0 0-.017.055c.001.02.006.039.017.056.441.774 1.551 2.527 3.307 4.08C6.691 17.685 9.045 19 12 19c2.955 0 5.31-1.315 7.06-2.864 1.756-1.553 2.866-3.306 3.307-4.08a.111.111 0 0 0 .017-.056.111.111 0 0 0-.017-.056c-.441-.773-1.551-2.527-3.307-4.08C17.309 6.315 14.955 5 12 5 9.045 5 6.69 6.314 4.94 7.865c-1.756 1.552-2.866 3.306-3.307 4.08Z"></path></svg>
                </div>
            </div>
        @endif
    </div>

</section>
