<?php

namespace App\Filament\Resources\PermohonanSelesaiResource\Pages;

use App\Filament\Resources\PermohonanSelesaiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPermohonanSelesai extends EditRecord
{
    protected static string $resource = PermohonanSelesaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
