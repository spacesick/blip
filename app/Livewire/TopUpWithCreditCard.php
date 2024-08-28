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
        $res = $creditCardService->charge($tokenId, $tokenAuth, $this->form->amount);
        if ($res['success']) {
            $imageUrl = $this->form->image_attachment->store('images', 'public');
            $transactions->newCredit(
                $this->form->idempotent_key,
                $this->form->amount,
                $this->form->details,
                $imageUrl
            );
            return $this->redirect(route('dashboard'));
        }
        else {
            $this->addError('flow_error', $res['message']);
            return;
        }
    }

    #[On('tokenization-error')]
    public function tokenizationError($err) {
        $this->addError('flow_error', $err);
        $this->dispatch('close-modal', 'request-secure-auth');
    }

    public function render()
    {
        $this->form->idempotent_key = (string) Str::uuid();
        return view('livewire.top-up-with-credit-card');
    }
}
