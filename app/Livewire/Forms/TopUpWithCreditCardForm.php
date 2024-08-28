<?php

namespace App\Livewire\Forms;

use App\Http\Requests\TopUpWithCreditCardRequest;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TopUpWithCreditCardForm extends Form
{
    public $idempotent_key;

    public $amount;

    public $details;

    public $image_attachment;

    public $card_number = '4000000000001091';

    public $card_name = 'Test';

    public $card_exp_month = '12';

    public $card_exp_year = '2040';

    public $card_cvv = '123';

    protected function rules(): array
    {
        return (new TopUpWithCreditCardRequest())->rules();
    }
}
