<?php

namespace App\Filament\Resources\AduanMasyarakatResource\Pages;

use App\Filament\Resources\AduanMasyarakatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAduanMasyarakats extends ListRecords
{
    protected static string $resource = AduanMasyarakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
