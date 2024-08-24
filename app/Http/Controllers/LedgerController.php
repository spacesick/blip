<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreditTransactionRequest;
use App\Http\Requests\DebitTransactionRequest;
use App\Models\Account;
use App\Models\Transaction;
use App\Services\Interface\TransactionService;
use App\Services\TransactionServiceImpl;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

/**
 * @property \App\Services\Interface\TransactionService $transactions
 */
class LedgerController extends Controller
{
    use AuthorizesRequests;

    public function __construct(protected TransactionService $transactions) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Transaction::class);

        $userLedger = $this->transactions->getUserLedger();
    }

    /**
     * Display the credit transaction form.
     */
    public function createCreditTransaction()
    {
        return view('transaction.create-credit');
    }

    /**
     * Display the debit transaction form.
     */
    public function createDebitTransaction()
    {
        return view('transaction.create-debit');
    }

    /**
     * Create a new credit transaction with the current user's account.
     */
    public function storeCreditTransaction(CreditTransactionRequest $request)
    {
        $data = $request->safe()->only(['idempotent_key', 'amount', 'details']);
        $imageUrl = $request->file('image_attachment')->store('images', 'public');

        $this->transactions->newCredit($data['idempotent_key'], $data['amount'], $data['details'], $imageUrl);

        return redirect()->route('dashboard');
    }

    /**
     * Create a new debit transaction with the current user's account.
     */
    public function storeDebitTransaction(DebitTransactionRequest $request)
    {
        $data = $request->safe()->only(['idempotent_key', 'amount', 'details']);
        $imageUrl = null;
        if ($request->hasFile('image_attachment')) {
            $imageUrl = $request->file('image_attachment')->store('images', 'public');
        }

        $this->transactions->newDebit($data['idempotent_key'], $data['amount'], $data['details'], $imageUrl);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction);

        $imageAttachment = $this->transactions->imageAttachment($transaction->code);

        return view('transaction.show', [
            'transaction' => $transaction,
            'image' => $imageAttachment ? asset('storage/'.$imageAttachment->image_url) : null,
        ]);
    }
}
