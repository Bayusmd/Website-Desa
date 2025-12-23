<?php

namespace App\Filament\Resources\PermohonanSelesaiResource\Pages;

use App\Filament\Resources\PermohonanSelesaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermohonanSelesais extends ListRecords
{
    protected static string $resource = PermohonanSelesaiResource::class;
     protected static ?string $title = 'Daftar Permohonan Surat Selesai';

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
