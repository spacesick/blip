<?php

namespace App\Livewire;

use App\Models\Transaction;
use App\Services\Interface\TransactionService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class LedgerTable extends Component
{
    use WithPagination;

    public int $perPage = 10;

    public ?string $searchTerm = null;

    public string $sortBy = 'created_at';
    public bool $sortDesc = true;

    public function updatePagination()
    {
        $this->resetPage();
    }

    public function sort(string $by)
    {
        $this->sortDesc = !($this->sortBy === $by) || !$this->sortDesc;
        $this->sortBy = $by;
    }

    public function render(TransactionService $transactions): View
    {
        return view('livewire.ledger-table', [
            'transactions' => $transactions->getUserLedger($this->perPage, $this->searchTerm, $this->sortBy, $this->sortDesc ? 'desc' : 'asc'),
        ]);
    }
}
