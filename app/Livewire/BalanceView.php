<?php

namespace App\Livewire;

use App\Services\Interface\AccountService;
use Livewire\Component;

class BalanceView extends Component
{
    public ?string $balance = null;

    public function fetchBalance(AccountService $accounts)
    {
        $this->balance = $accounts->getUserBalance();
    }

    public function render()
    {
        return view('livewire.balance-view', [
            'balance' => $this->balance
        ]);
    }
}
