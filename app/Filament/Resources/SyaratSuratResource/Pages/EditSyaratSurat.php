<?php

namespace App\Filament\Resources\SyaratSuratResource\Pages;

use App\Filament\Resources\SyaratSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSyaratSurat extends EditRecord
{
    protected static string $resource = SyaratSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
