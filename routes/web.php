<?php

// routes/web.php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookDetailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::get('/home', [BookController::class, 'index'])->name('books.index');
// routes/web.php
Route::get('/books/{book}', [BookDetailController::class, 'show'])->name('books.show');
// Static pages
Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

Route::get('/kontak', function () {
    return view('contact');
})->name('contact');

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
