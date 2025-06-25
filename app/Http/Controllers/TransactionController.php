<?php

// app/Http/Controllers/TransactionController.php
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        DB::beginTransaction();

        try {
            // Create transaction
            $transaction = new Transaction();
            $transaction->user_id = Auth::id();
            $transaction->total_amount = 0;
            $transaction->status = 'pending';
            $transaction->save();

            $totalAmount = 0;

            // Create transaction details
            foreach ($cart as $id => $details) {
                $book = Book::find($id);

                if (!$book || $book->stock < $details['quantity']) {
                    throw new \Exception("Stok buku {$details['title']} tidak mencukupi.");
                }

                $detail = new TransactionDetail();
                $detail->transaction_id = $transaction->id;
                $detail->book_id = $id;
                $detail->quantity = $details['quantity'];
                $detail->price = $details['price'];
                $detail->save();

                $totalAmount += $details['price'] * $details['quantity'];

                // Reduce stock
                $book->stock -= $details['quantity'];
                $book->save();
            }

            // Update transaction total
            $transaction->total_amount = $totalAmount;
            $transaction->save();

            // Clear cart
            session()->forget('cart');

            DB::commit();

            return redirect()->route('payments.create', $transaction)
                ->with('success', 'Transaksi berhasil dibuat. Silakan lakukan pembayaran.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }

    public function index(Request $request)
{
    $query = Auth::user()->transactions()->latest();

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('id', 'like', "%$search%")
              ->orWhere('total_amount', 'like', "%$search%");
        });
    }

    if ($request->filled('status')) {
        $query->where('status', $request->input('status'));
    }

    $transactions = $query->paginate(10)->withQueryString(); // penting agar filter tetap saat pagination

    return view('transactions.index', compact('transactions'));
}


    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        return view('transactions.show', compact('transaction'));
    }
}
