<?php

// routes/web.php
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [BookController::class, 'index'])->name('home');



// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{book}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{book}', [CartController::class, 'update'])->name('cart.update');

    // Checkout
    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout');

    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

    // Payments
    Route::get('/payments/{transaction}/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/{transaction}', [PaymentController::class, 'store'])->name('payments.store');

    // Downloads
    Route::get('/download/{book}', [BookController::class, 'download'])->name('books.download');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
