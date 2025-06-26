<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Book;
use App\Models\User;
use App\Models\Transaction;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Menghitung total pendapatan dari transaksi yang berhasil
        $totalRevenue = Transaction::where('status', 'completed')->sum('total_amount');

        return [
            Stat::make('Total Pengguna', User::count())
                ->description('Jumlah pengguna terdaftar')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Buku', Book::count())
                ->description('Jumlah judul buku di katalog')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Transaksi', Transaction::count())
                ->description('Jumlah semua transaksi')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 2, ',', '.'))
                ->description('Dari transaksi yang berhasil')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
