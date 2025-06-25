<?php

// app/Http/Controllers/BookController.php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
{
    $query = Book::where('stock', '>', 0);

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%");
        });
    }
    if ($request->filled('format')){
        $format = $request->input('format');
        $query->where('book_type', $format);
    }

    $books = $query->paginate(12)->withQueryString();

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
