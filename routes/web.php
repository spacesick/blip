<?php

use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ProfileController;
use App\Livewire\CreateDebitTransaction;
use App\Livewire\TopUpWithCreditCard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/transfer', [LedgerController::class, 'createDebitTransaction'])->name('transfer');
    Route::post('/transfer', [LedgerController::class, 'storeDebitTransaction'])->name('transfer');

    Route::get('/transactions/{transaction}', [LedgerController::class, 'show'])->name('transactions');

    Route::get('/top-up', TopUpWithCreditCard::class)->name('top-up');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
