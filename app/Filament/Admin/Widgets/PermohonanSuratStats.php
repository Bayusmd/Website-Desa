<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\PermohonanSurat;
use Carbon\Carbon;

class PermohonanSuratStats extends BaseWidget
{
    protected function getStats(): array
    {
        $bulanIni = Carbon::now();
        $bulanLalu = Carbon::now()->subMonth();

        $total = PermohonanSurat::count();

        $bulanIniCount = PermohonanSurat::whereMonth('tanggal_permohonan', $bulanIni->month)
            ->whereYear('tanggal_permohonan', $bulanIni->year)
            ->count();

        $bulanLaluCount = PermohonanSurat::whereMonth('tanggal_permohonan', $bulanLalu->month)
            ->whereYear('tanggal_permohonan', $bulanLalu->year)
            ->count();

        $persentase = $bulanLaluCount > 0
            ? round((($bulanIniCount - $bulanLaluCount) / $bulanLaluCount) * 100, 1)
            : 100;

        $icon = $persentase > 0
            ? 'heroicon-o-arrow-trending-up'
            : ($persentase < 0
                ? 'heroicon-o-arrow-trending-down'
                : 'heroicon-o-minus');

        $warna = $persentase > 0
            ? 'info'     // 🔵 naik
            : ($persentase < 0
                ? 'danger' // 🔴 turun
                : 'gray'); // ⚪ stabil


        return [
            Stat::make('Total Permohonan', $total)
            ->description(
                ($persentase >= 0 ? '+' : '') . $persentase . '% dari bulan lalu'
            )
            ->descriptionIcon($icon)
            ->color($warna),


            Stat::make('Menunggu', PermohonanSurat::where('status_permohonan', 'baru')->count())
                ->description('Belum diproses')
                ->descriptionIcon('heroicon-o-clock')
                ->color('danger'),

            Stat::make('Diproses', PermohonanSurat::where('status_permohonan', 'proses')->count())
                ->description('Permohonan Diproses')
                ->descriptionIcon('heroicon-o-arrow-path')
                ->color('warning'),

            Stat::make('Selesai', PermohonanSurat::where('status_permohonan', 'selesai')->count())
                ->description('Permohonan Selesai')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
