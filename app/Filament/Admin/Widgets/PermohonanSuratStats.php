<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\PermohonanSurat;

class PermohonanSuratStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
             Stat::make('Total Pemohonan', PermohonanSurat::count())
                ->description('Semua permohonan yang diajukan')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('info'),

            Stat::make('Menunggu', PermohonanSurat::where('status_permohonan', 'baru')->count())
                ->description('Belum diproses')
                ->descriptionIcon('heroicon-o-clock')
                ->color('danger'),

            Stat::make('Diproses', PermohonanSurat::where('status_permohonan', 'proses')->count())
                ->description('Permohonan Diproses')
                ->descriptionIcon('heroicon-o-arrow-path')
                ->color('warning'),

            Stat::make('Selesai', PermohonanSurat::where('status_permohonan', 'selesai')->count())
                ->description('Permohonan Telah Selesai')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
