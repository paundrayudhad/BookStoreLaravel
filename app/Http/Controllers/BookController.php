<?php

// app/Http/Controllers/BookController.php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::where('stock', '>', 0)->paginate(12);
        return view('books.index', compact('books'));
    }

    public function download(Book $book)
    {
        $user = Auth::user();

        // Check if user has purchased the book and payment is verified
        $hasPurchased = $user->transactions()
            ->where('status', 'completed')
            ->whereHas('details', function($query) use ($book) {
                $query->where('book_id', $book->id);
            })
            ->exists();

        if (!$hasPurchased) {
            return redirect()->back()->with('error', 'Anda belum membeli buku ini atau pembayaran belum diverifikasi.');
        }

        if (Storage::exists($book->pdf_file)) {
            return Storage::download($book->pdf_file, $book->title . '.pdf');
        }

        return redirect()->back()->with('error', 'File buku tidak ditemukan.');
    }
}
