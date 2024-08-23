<section>
    <div class="border border-neutral-200 rounded-md text-sm px-2.5">
        <table class="w-full text-left">
            <thead class="border-b">
            <tr class="h-10 align-middle">
                <th scope="col" colspan="1" class="px-4 font-medium">
                    Code
                </th>
                <th scope="col" colspan="1" class="px-4 border-l font-medium">
                    Entry
                </th>
                <th scope="col" colspan="1" class="px-4 border-l font-medium">
                    Amount
                </th>
                <th scope="col" colspan="1" class="px-4 font-medium" />
            </tr>
            </thead>
            <tbody class="divide-y font-mono">
            @foreach ($transactions as $transaction)
                <tr class="h-10 align-middle">
                    <td colspan="1" class="px-4">
                        {{ $transaction->code }}
                    </td>
                    <td colspan="1" class="px-4">
                        {{ $transaction->entry }}
                    </td>
                    <td colspan="1" class="px-4 text-end">
                        {{ $transaction->amount }}
                    </td>
                    <td colspan="1" class="">
                        <div class="flex align-middle justify-center">
                            <x-primary-button>

                            </x-primary-button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex justify-between p-4">
        <div class="text-sm">
            @php
                $start = ($transactions->currentPage() - 1) * $transactions->perPage() + 1;
                $end = $start - 1 + $transactions->count();
            @endphp
            Showing {{ $start }} to {{ $end }} of {{ $transactions->total() }} records.
        </div>
        <div>
            @if ($transactions->hasPages())
                @if (!$transactions->onFirstPage())
                    <x-primary-button>
                        <a class="px-4 py-2" href="{{ $transactions->previousPageUrl() }}">
                            Previous
                        </a>
                    </x-primary-button>
                @endif
                @if (!$transactions->onLastPage())
                    <x-primary-button>
                        <a class="px-4 py-2" href="{{ $transactions->nextPageUrl() }}">
                            Next
                        </a>
                    </x-primary-button>
                @endif
            @endif
        </div>
    </div>
</section>
