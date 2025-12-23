<?php

namespace App\Filament\Resources\LayananSuratResource\Pages;

use App\Filament\Resources\LayananSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLayananSurats extends ListRecords
{
    protected static string $resource = LayananSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
