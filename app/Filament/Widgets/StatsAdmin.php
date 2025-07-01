<?php

namespace App\Filament\Widgets;

use App\Models\FadhilBooks;
use App\Models\FadhilLoan;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdmin extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Buku', FadhilBooks::count())
                ->description('Jumlah semua judul buku di perpustakaan')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('success'),

            Stat::make('Total Pengguna', User::count())
                ->description('Jumlah semua pengguna terdaftar (member & admin)')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('Buku Sedang Dipinjam', FadhilLoan::where('status', 'borrowed')->count())
                ->description('Jumlah buku yang belum dikembalikan')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),
        ];
    }
}
