<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the welcome page with dynamic content.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        // Ambil statistik untuk hero section
        $totalBooks = Book::count();
        $totalAuthors = Book::distinct('author')->count();

        // Ambil buku terbaru (berdasarkan created_at)
        $latestBooks = Book::orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Ambil buku terlaris (berdasarkan jumlah penjualan)
        // Asumsi: buku dengan stock paling sedikit adalah yang paling laris
        $bestSellerBooks = Book::select('books.*', DB::raw('SUM(transaction_details.quantity) as total_sold'))
                ->join('transaction_details', 'books.id', '=', 'transaction_details.book_id')
                ->groupBy('books.id')
                ->orderByDesc('total_sold')
                ->take(4)
                ->get();

        // Ambil buku dengan harga terendah untuk showcase
        $affordableBooks = Book::orderBy('price', 'asc')
            ->take(3)
            ->get();

        return view('welcome', compact(
            'totalBooks',
            'totalAuthors',
            'latestBooks',
            'bestSellerBooks',
            'affordableBooks'
        ));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Untuk halaman home/dashboard yang berbeda dari welcome
        $books = Book::paginate(12);
        return view('home', compact('books'));
    }
}
