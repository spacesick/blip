<?php

namespace App\Livewire;

use App\Livewire\Forms\TopUpWithCreditCardForm;
use App\Services\Interface\CreditCardService;
use App\Services\Interface\TransactionService;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Str;

class TopUpWithCreditCard extends Component
{
    use WithFileUploads;

    public TopUpWithCreditCardForm $form;

    public function save() {
        $this->validate();

        $this->dispatch('create-token')->self();
    }

    #[On('charge')]
    public function charge(
        $tokenId, $tokenAuth,
        CreditCardService $creditCardService,
        TransactionService $transactions
    ) {
        error_log($tokenId.' '.$tokenAuth);
        abort(501, 'TODO: Charge the card');
    }

    public function tokenizationError($err) {
        error_log($err);
        abort(501, 'Tokenization failed');
    }

    public function render()
    {
        $this->form->idempotent_key = (string) Str::uuid();
        return view('livewire.top-up-with-credit-card');
    }
}
