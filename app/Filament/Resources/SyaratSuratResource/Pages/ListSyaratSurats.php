<?php

namespace App\Filament\Resources\SyaratSuratResource\Pages;

use App\Filament\Resources\SyaratSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSyaratSurats extends ListRecords
{
    protected static string $resource = SyaratSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
