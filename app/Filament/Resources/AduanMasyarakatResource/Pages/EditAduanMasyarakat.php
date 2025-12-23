<?php

namespace App\Filament\Resources\AduanMasyarakatResource\Pages;

use App\Filament\Resources\AduanMasyarakatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAduanMasyarakat extends EditRecord
{
    protected static string $resource = AduanMasyarakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
