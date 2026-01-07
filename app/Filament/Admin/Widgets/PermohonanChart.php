<?php

namespace App\Filament\Admin\Widgets;

use App\Models\PermohonanSurat;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;


class PermohonanChart extends ChartWidget
{
    protected static ?string $heading = null;

    protected function getData(): array
    {
        $tahun = now()->year;

        static::$heading = 'Grafik Permohonan Surat Tahun ' . $tahun;

        $labels = [];
        $values = [];

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $labels[] = \Carbon\Carbon::create()
                ->month($bulan)
                ->translatedFormat('F');

            $values[] = PermohonanSurat::whereYear('tanggal_permohonan', $tahun)
                ->whereMonth('tanggal_permohonan', $bulan)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Permohonan ' . $tahun,
                    'data' => $values,

                    // 🎨 WARNA CUSTOM
                    'borderColor' => '#2563EB',
                    'backgroundColor' => 'rgba(37,99,235,0.25)',
                    'pointBackgroundColor' => '#1D4ED8',
                    'pointBorderColor' => '#1D4ED8',
                    'tension' => 0.4,
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}













