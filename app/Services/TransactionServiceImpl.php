<?php

namespace App\Services;

use App\Exceptions\InsufficientBalanceException;
use App\Models\Account;
use App\Models\ImageAttachment;
use App\Models\Transaction;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;
use Money\Parser\DecimalMoneyParser;

/**
 * @property \Money\Parser\DecimalMoneyParser $balanceParser
 */
class TransactionServiceImpl implements Interface\TransactionService
{
    public function __construct(
        protected DecimalMoneyParser $balanceParser,
        protected DecimalMoneyFormatter $balanceSerializer,
    ) {}

    public function newCredit(string $idempotentKey, string $amount, ?string $details, ?string $imageUrl): mixed
    {
        DB::beginTransaction();

        if (Transaction::whereIdempotentKey($idempotentKey)->first()) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => 'A request with the same idempotent key for the same operation is being processed or is outstanding!'
            ];
        }

        $transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->entry = Transaction::CREDIT;
        $transaction->idempotent_key = $idempotentKey;
        $transaction->code = 'TC/'.date('YmdHis').'/'.bin2hex(random_bytes(3));
        $transaction->amount = $amount;
        $transaction->details = $details;

        if ($imageUrl) {
            $transactionAttachment = new ImageAttachment();
            $transactionAttachment->image_url = $imageUrl;

            if (!$transactionAttachment->save()) {
                DB::rollBack();
                return [
                    'success' => false,
                    'error' => 'Unable to save your image attachment!'
                ];
            }

            $transaction->image_attachment_id = $transactionAttachment->id;
        }

        if (!$transaction->save()) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => 'Unable to save your transaction! The transaction is cancelled.'
            ];
        }

        $userAccount = Account::whereUserId(Auth::id())->first();
        $balance = $this->balanceParser->parse(
            $userAccount->balance,
            new Currency('IDR')
        );
        $credit = $this->balanceParser->parse(
            $amount,
            new Currency('IDR')
        );
        $userAccount->balance = $this->balanceSerializer->format($balance->add($credit));

        if (!$userAccount->save()) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => 'Unable to update balance! The transaction is cancelled.'
            ];
        }

        DB::commit();
        return [
            'success' => true,
            'error' => null
        ];
    }

    public function newDebit(string $idempotentKey, string $amount, ?string $details, ?string $imageUrl): mixed
    {
        DB::beginTransaction();

        if (Transaction::whereIdempotentKey($idempotentKey)->first()) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => 'A request with the same idempotent key for the same operation is being processed or is outstanding!'
            ];
        }

        $transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->entry = Transaction::DEBIT;
        $transaction->idempotent_key = $idempotentKey;
        $transaction->code = 'TD/'.date('YmdHis').'/'.bin2hex(random_bytes(3));
        $transaction->amount = $amount;
        $transaction->details = $details;

        if ($imageUrl) {
            $transactionAttachment = new ImageAttachment();
            $transactionAttachment->image_url = $imageUrl;

            if (!$transactionAttachment->save()) {
                DB::rollBack();
                return [
                    'success' => false,
                    'error' => 'Unable to save your image attachment!'
                ];
            }

            $transaction->image_attachment_id = $transactionAttachment->id;
        }

        if (!$transaction->save()) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => 'Unable to save your transaction! The transaction is cancelled.'
            ];
        }

        $userAccount = Account::whereUserId(Auth::id())->first();
        $balance = $this->balanceParser->parse(
            $userAccount->balance,
            new Currency('IDR')
        );
        $debit = $this->balanceParser->parse(
            $amount,
            new Currency('IDR')
        );
        if ($balance->lessThan($debit)) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => 'You have insufficient balance!'
            ];
        }
        $userAccount->balance = $this->balanceSerializer->format($balance->subtract($debit));

        if (!$userAccount->save()) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => 'Unable to update balance! The transaction is cancelled.'
            ];
        }

        DB::commit();
        return [
            'success' => true,
            'error' => null
        ];
    }

    public function getUserLedger(int $perPage, ?string $searchTerm, string $sortBy, string $sortDirection): LengthAwarePaginator|Transaction
    {
        $ledger = Transaction::whereUserId(Auth::id());

        if ($searchTerm) {
            $ledger
                ->where('details', 'like', "%$searchTerm%")
                ->orWhere('code', 'like', "%$searchTerm%")
                ->orWhere('amount', 'like', "%$searchTerm%")
                ->orWhere('created_at', 'like', "%$searchTerm%")
                ->orWhere('entry', 'like', "%$searchTerm%");
        }

        return $ledger
            ->orderBy($sortBy, $sortDirection)
            ->paginate($perPage);
    }

    public function get(string $code)
    {
        return Transaction::whereCode($code)->first();
    }

    public function imageAttachment(string $code): ?ImageAttachment
    {
        $transaction = Transaction::whereCode($code)->first();
        return ImageAttachment::whereId($transaction->image_attachment_id)->first();
    }
}
