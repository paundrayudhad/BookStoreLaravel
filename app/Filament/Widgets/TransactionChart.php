<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TransactionChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Transaksi per Bulan';
    protected static ?int $sort = 2; // Urutan di dashboard

    protected function getData(): array
    {
        $driver = DB::connection()->getDriverName();
        $year = now()->format('Y');

        if ($driver === 'sqlite') {
            $data = Transaction::selectRaw("strftime('%m', created_at) as month, COUNT(*) as total")
                ->whereRaw("strftime('%Y', created_at) = ?", [$year])
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        } else {
            $data = Transaction::selectRaw("MONTH(created_at) as month, COUNT(*) as total")
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        }

        // Inisialisasi 12 bulan
        $monthlyCounts = array_fill(1, 12, 0);

        foreach ($data as $item) {
            $monthNumber = (int) ltrim($item->month, '0'); // dari '01' jadi 1
            $monthlyCounts[$monthNumber] = $item->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Transaksi',
                    'data' => array_values($monthlyCounts),
                    'backgroundColor' => '#3b82f6',
                    'borderColor' => '#1d4ed8',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Ganti jadi 'line' jika ingin chart garis
    }
}
