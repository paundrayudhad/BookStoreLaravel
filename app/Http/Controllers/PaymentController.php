<?php

// app/Http/Controllers/PaymentController.php
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function create(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id() || $transaction->status !== 'pending') {
            abort(403);
        }

        return view('payments.create', compact('transaction'));
    }

    public function store(Request $request, Transaction $transaction)
    {
        $request->validate([
            'payment_method' => 'required|in:bank_transfer,qris',
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Save proof image
        $path = $request->file('proof')->store('payment-proofs');

        // Create payment record
        $payment = new Payment();
        $payment->transaction_id = $transaction->id;
        $payment->payment_method = $request->payment_method;
        $payment->proof = $path;
        $payment->status = 'pending';
        $payment->save();

        // Update transaction status
        $transaction->status = 'paid';
        $transaction->save();

        return redirect()->route('transactions.show', $transaction)
            ->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.');
    }
}
