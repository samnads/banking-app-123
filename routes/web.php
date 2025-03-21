<?php

use App\Http\Controllers\DepositController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/deposit', [DepositController::class, 'deposit'])->name('deposit');
    Route::post('/deposit', [DepositController::class, 'save_deposit'])->name('deposit.save');

    Route::get('/withdraw', [WithdrawController::class, 'withdraw'])->name('withdraw');
    Route::post('/withdraw', [WithdrawController::class, 'withdraw_now'])->name('withdraw.save');

    Route::get('/transfer', [TransferController::class, 'transfer'])->name('transfer');
    Route::post('/transfer', [TransferController::class, 'transfer_now'])->name('transfer.save');

    Route::get('/statement', [StatementController::class, 'statement'])->name('statement');
});

require __DIR__.'/auth.php';
