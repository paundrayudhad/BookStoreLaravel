<?php

// app/Http/Controllers/BookDetailController.php
namespace App\Http\Controllers;

use App\Models\Book;

class BookDetailController extends Controller
{
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}
