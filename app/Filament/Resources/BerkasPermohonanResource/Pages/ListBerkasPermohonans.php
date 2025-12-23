<?php

namespace App\Filament\Resources\BerkasPermohonanResource\Pages;

use App\Filament\Resources\BerkasPermohonanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBerkasPermohonans extends ListRecords
{
    protected static string $resource = BerkasPermohonanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
