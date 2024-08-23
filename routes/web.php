<?php

use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ProfileController;
use App\Livewire\CreateDebitTransaction;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/transfer/credit', [LedgerController::class, 'createCreditTransaction'])->name('transfer-c');
    Route::post('/transfer/credit', [LedgerController::class, 'storeCreditTransaction'])->name('transfer-c');

    Route::get('/transfer/debit', [LedgerController::class, 'createDebitTransaction'])->name('transfer-d');
    Route::post('/transfer/debit', [LedgerController::class, 'storeDebitTransaction'])->name('transfer-d');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
