<?php

// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Book $book)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$book->id])) {
            $cart[$book->id]['quantity']++;
        } else {
            $cart[$book->id] = [
                'title' => $book->title,
                'author' => $book->author,
                'price' => $book->price,
                'quantity' => 1,
                'cover' => $book->cover_image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Buku ditambahkan ke keranjang.');
    }

    public function remove(Book $book)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$book->id])) {
            unset($cart[$book->id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Buku dihapus dari keranjang.');
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$book->id])) {
            $cart[$book->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Jumlah buku diperbarui.');
    }
}
