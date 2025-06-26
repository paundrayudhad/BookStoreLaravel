<?php

namespace App\Filament\Widgets;

use App\Models\TransactionDetail;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class BookTypeSalesChart extends ChartWidget
{
    protected static ?string $heading = 'Penjualan Buku per Jenis';
    protected static ?int $sort = 2; // Urutan di dashboard

    protected function getData(): array
    {
        $data = TransactionDetail::selectRaw('books.book_type, SUM(transaction_details.quantity) as total')
            ->join('books', 'transaction_details.book_id', '=', 'books.id')
            ->groupBy('books.book_type')
            ->get();

        $labels = [];
        $totals = [];

        foreach ($data as $item) {
            $labels[] = ucfirst($item->type); // Fisik / Digital
            $totals[] = $item->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Buku Terjual',
                    'data' => $totals,
                    'backgroundColor' => ['#10b981', '#6366f1'], // Hijau & Ungu
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut'; // Bisa diganti ke 'bar' atau 'pie'
    }
}
