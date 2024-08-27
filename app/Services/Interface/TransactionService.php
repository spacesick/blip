<?php

namespace App\Services\Interface;

use App\Http\Requests\CreditTransactionRequest;
use App\Http\Requests\DebitTransactionRequest;
use App\Models\ImageAttachment;
use App\Models\Transaction;
use Illuminate\Pagination\LengthAwarePaginator;

interface TransactionService
{
    public function newCredit(string $idempotentKey, string $amount, ?string $details, ?string $imageUrl): void;

    public function newDebit(string $idempotentKey, string $amount, ?string $details, ?string $imageUrl): void;

    public function getUserLedger(int $perPage, ?string $searchTerm, string $sortBy, string $sortDirection): LengthAwarePaginator|Transaction;

    public function get(string $code);

    public function imageAttachment(string $code): ?ImageAttachment;
}
