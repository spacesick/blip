<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'idempotent_key' => ['required', 'uuid'],
            'amount' => ['required', 'decimal:2', 'min:0'],
            'details' => ['nullable'],
            'image_attachment' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:1024'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'amount' => str_replace(['.', ','], ['', '.'], $this->amount),
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }
}
