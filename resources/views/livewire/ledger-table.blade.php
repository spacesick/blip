<section>
    <div class="pb-4">
        <x-text-input wire:model.live="searchTerm" placeholder="Filter">
            <div class="px-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M10.68 11.74a6 6 0 0 1-7.922-8.982 6 6 0 0 1 8.982 7.922l3.04 3.04a.749.749 0 0 1-.326 1.275.749.749 0 0 1-.734-.215ZM11.5 7a4.499 4.499 0 1 0-8.997 0A4.499 4.499 0 0 0 11.5 7Z"></path></svg>
            </div>
        </x-text-input>
    </div>
    <div class="border border-neutral-200 rounded-md text-sm">
        <table class="w-full text-left">
            <thead class="border-b">
            <tr class="h-10 align-middle bg-primary-100">
                <th wire:click="sort('code')" scope="col" colspan="1" class="px-4 font-medium fill-primary-500 hover:fill-accent-500 hover:bg-primary-200 transition cursor-pointer">
                    <div class="flex place-items-center">
                        Code
                        <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4"><path d="M4.93179 5.43179C4.75605 5.60753 4.75605 5.89245 4.93179 6.06819C5.10753 6.24392 5.39245 6.24392 5.56819 6.06819L7.49999 4.13638L9.43179 6.06819C9.60753 6.24392 9.89245 6.24392 10.0682 6.06819C10.2439 5.89245 10.2439 5.60753 10.0682 5.43179L7.81819 3.18179C7.73379 3.0974 7.61933 3.04999 7.49999 3.04999C7.38064 3.04999 7.26618 3.0974 7.18179 3.18179L4.93179 5.43179ZM10.0682 9.56819C10.2439 9.39245 10.2439 9.10753 10.0682 8.93179C9.89245 8.75606 9.60753 8.75606 9.43179 8.93179L7.49999 10.8636L5.56819 8.93179C5.39245 8.75606 5.10753 8.75606 4.93179 8.93179C4.75605 9.10753 4.75605 9.39245 4.93179 9.56819L7.18179 11.8182C7.35753 11.9939 7.64245 11.9939 7.81819 11.8182L10.0682 9.56819Z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    </div>
                </th>
                <th wire:click="sort('entry')" scope="col" colspan="1" class="px-4 border-l font-medium fill-primary-500 hover:fill-accent-500 hover:bg-primary-200 transition cursor-pointer">
                    <div class="flex place-items-center">
                        Entry
                        <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4"><path d="M4.93179 5.43179C4.75605 5.60753 4.75605 5.89245 4.93179 6.06819C5.10753 6.24392 5.39245 6.24392 5.56819 6.06819L7.49999 4.13638L9.43179 6.06819C9.60753 6.24392 9.89245 6.24392 10.0682 6.06819C10.2439 5.89245 10.2439 5.60753 10.0682 5.43179L7.81819 3.18179C7.73379 3.0974 7.61933 3.04999 7.49999 3.04999C7.38064 3.04999 7.26618 3.0974 7.18179 3.18179L4.93179 5.43179ZM10.0682 9.56819C10.2439 9.39245 10.2439 9.10753 10.0682 8.93179C9.89245 8.75606 9.60753 8.75606 9.43179 8.93179L7.49999 10.8636L5.56819 8.93179C5.39245 8.75606 5.10753 8.75606 4.93179 8.93179C4.75605 9.10753 4.75605 9.39245 4.93179 9.56819L7.18179 11.8182C7.35753 11.9939 7.64245 11.9939 7.81819 11.8182L10.0682 9.56819Z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    </div>
                </th>
                <th wire:click="sort('amount')" scope="col" colspan="1" class="px-4 border-l font-medium fill-primary-500 hover:fill-accent-500 hover:bg-primary-200 transition cursor-pointer">
                    <div class="flex place-items-center">
                        Amount
                        <svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4"><path d="M4.93179 5.43179C4.75605 5.60753 4.75605 5.89245 4.93179 6.06819C5.10753 6.24392 5.39245 6.24392 5.56819 6.06819L7.49999 4.13638L9.43179 6.06819C9.60753 6.24392 9.89245 6.24392 10.0682 6.06819C10.2439 5.89245 10.2439 5.60753 10.0682 5.43179L7.81819 3.18179C7.73379 3.0974 7.61933 3.04999 7.49999 3.04999C7.38064 3.04999 7.26618 3.0974 7.18179 3.18179L4.93179 5.43179ZM10.0682 9.56819C10.2439 9.39245 10.2439 9.10753 10.0682 8.93179C9.89245 8.75606 9.60753 8.75606 9.43179 8.93179L7.49999 10.8636L5.56819 8.93179C5.39245 8.75606 5.10753 8.75606 4.93179 8.93179C4.75605 9.10753 4.75605 9.39245 4.93179 9.56819L7.18179 11.8182C7.35753 11.9939 7.64245 11.9939 7.81819 11.8182L10.0682 9.56819Z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    </div>
                </th>
                <th scope="col" colspan="1" class="px-4 font-medium" />
            </tr>
            </thead>
            <tbody class="divide-y font-mono">
            @if ($transactions->isEmpty())
                <tr class="h-10 align-middle">
                    <td colspan="4" class="px-4 text-center">
                        No transactions found here!
                    </td>
                </tr>
            @else
            @foreach ($transactions as $transaction)
                <tr class="h-10 align-middle">
                    <td colspan="1" class="px-4">
                        {{ $transaction->code }}
                    </td>
                    <td colspan="1" class="px-4">
                        {{ Str::ucfirst($transaction->entry) }}
                    </td>
                    <td colspan="1" class="px-4 text-end">
                        <div class="flex justify-between">
                            <div>
                                Rp.
                            </div>
                            <div>
                                {{ number_format($transaction->amount, 2, ',', '.') }}
                            </div>
                        </div>
                    </td>
                    <td colspan="1" class="">
                        <div class="flex align-middle justify-center">
                            <a href="/transactions/{{ $transaction->id }}" class="fill-neutral-500 p-2 align-center items-center rounded-md font-semibold text-xs text-gray-700 hover:bg-primary-200 focus:outline-none focus:bg-primary-200 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8Zm8-6.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13ZM6.92 6.085h.001a.749.749 0 1 1-1.342-.67c.169-.339.436-.701.849-.977C6.845 4.16 7.369 4 8 4a2.756 2.756 0 0 1 1.637.525c.503.377.863.965.863 1.725 0 .448-.115.83-.329 1.15-.205.307-.47.513-.692.662-.109.072-.22.138-.313.195l-.006.004a6.24 6.24 0 0 0-.26.16.952.952 0 0 0-.276.245.75.75 0 0 1-1.248-.832c.184-.264.42-.489.692-.661.103-.067.207-.132.313-.195l.007-.004c.1-.061.182-.11.258-.161a.969.969 0 0 0 .277-.245C8.96 6.514 9 6.427 9 6.25a.612.612 0 0 0-.262-.525A1.27 1.27 0 0 0 8 5.5c-.369 0-.595.09-.74.187a1.01 1.01 0 0 0-.34.398ZM9 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path></svg>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="flex justify-between p-4">
        <div class="text-sm font-medium text-neutral-600">
            @php
                $start = ($transactions->currentPage() - 1) * $transactions->perPage() + 1;
                $end = $start - 1 + $transactions->count();
            @endphp
            Showing {{ $start }} to {{ $end }} of {{ $transactions->total() }} records.
        </div>
        <div class="flex gap-8">
            <div class="text-sm flex">
                <div class="align-top pr-4 font-medium text-neutral-600">
                    Rows per page:
                </div>
                <select wire:model.change="perPage" wire:input="updatePagination" name="perPage" id="perPage" class="inline-flex cursor-pointer items-center justify-center bg-primary-800 border border-transparent rounded-md font-semibold text-xs text-primary-50 tracking-wide border-none focus:outline-none focus:ring-0 focus-within:ring-0 hover:bg-accent-700 focus:bg-primary-800 transition">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
            </div>
            <div class="flex align-middle">
                @if ($transactions->hasPages())
                    @if (!$transactions->onFirstPage())
                        <x-primary-button class="rounded-r-none">
                            <div class="p-2 fill-neutral-50" wire:click="previousPage" wire:loading.attr="disabled" >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M9.78 12.78a.75.75 0 0 1-1.06 0L4.47 8.53a.75.75 0 0 1 0-1.06l4.25-4.25a.751.751 0 0 1 1.042.018.751.751 0 0 1 .018 1.042L6.06 8l3.72 3.72a.75.75 0 0 1 0 1.06Z"></path></svg>
                            </div>
                        </x-primary-button>
                    @endif
                    <div class="border border-neutral-300 text-sm font-medium w-8 flex justify-center place-items-center">
                        {{ $transactions->currentPage() }}
                    </div>
                    @if (!$transactions->onLastPage())
                        <x-primary-button class="rounded-l-none">
                            <a class="p-2 fill-neutral-50" wire:click="nextPage" wire:loading.attr="disabled" >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M6.22 3.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.751.751 0 0 1-1.042-.018.751.751 0 0 1-.018-1.042L9.94 8 6.22 4.28a.75.75 0 0 1 0-1.06Z"></path></svg>
                            </a>
                        </x-primary-button>
                    @endif
                @endif
            </div>
        </div>
    </div>
</section>
