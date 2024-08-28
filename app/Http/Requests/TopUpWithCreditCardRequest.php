<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopUpWithCreditCardRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'idempotent_key' => ['required', 'uuid'],
            'amount' => ['required', 'decimal:2', 'min:0'],
            'details' => ['nullable'],
            'image_attachment' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
            'card_number' => ['required', 'string', 'size:16'],
            'card_name' => ['required', 'string'],
            'card_exp_month' => ['required', 'string', 'size:2'],
            'card_exp_year' => ['required', 'string', 'size:4'],
            'card_cvv' => ['required', 'string', 'size:3'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
