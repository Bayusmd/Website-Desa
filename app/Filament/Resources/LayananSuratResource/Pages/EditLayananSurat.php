<?php

namespace App\Filament\Resources\LayananSuratResource\Pages;

use App\Filament\Resources\LayananSuratResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLayananSurat extends EditRecord
{
    protected static string $resource = LayananSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
