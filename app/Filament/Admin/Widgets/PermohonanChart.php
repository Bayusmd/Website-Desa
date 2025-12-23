<?php

namespace App\Filament\Admin\Widgets;

use App\Models\PermohonanSurat;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class PermohonanChart extends ChartWidget
{


    protected static ?string $heading = 'Grafik Permohonan Surat Desa Lemahbang';

    protected function getData(): array
        {
            // Buat data 12 bulan terakhir
            $labels = [];
            $values = [];

            for ($i = 1; $i <= 12; $i++) {
                $monthName = Carbon::create()->month($i)->format('F');
                $labels[] = $monthName;

                $count = PermohonanSurat::whereMonth('tanggal_permohonan', $i)->count();
                $values[] = $count;
            }

            return [
                'datasets' => [
                    [
                        'label' => 'Jumlah Permohonan',
                        'data' => $values,
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

