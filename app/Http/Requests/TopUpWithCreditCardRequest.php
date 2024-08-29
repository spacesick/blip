<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopUpWithCreditCardRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'idempotent_key' => ['required', 'uuid'],
            'amount' => ['required', 'decimal:0', 'min:5000'],
            'details' => ['nullable'],
            'image_attachment' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'card_number' => ['required', 'numeric'],
            'card_name' => ['required', 'string'],
            'card_exp_month' => ['required', 'integer', 'digits:2'],
            'card_exp_year' => ['required', 'integer', 'digits:4'],
            'card_cvv' => ['required', 'integer', 'digits:3'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
