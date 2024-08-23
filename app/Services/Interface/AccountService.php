<?php

namespace App\Services\Interface;

use App\Http\Requests\CreditTransactionRequest;
use App\Http\Requests\DebitTransactionRequest;
use App\Models\Transaction;
use Illuminate\Pagination\LengthAwarePaginator;

interface AccountService
{
    public function getUserBalance(): string;
}
