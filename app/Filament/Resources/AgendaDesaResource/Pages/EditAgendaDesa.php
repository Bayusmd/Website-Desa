<?php

namespace App\Filament\Resources\AgendaDesaResource\Pages;

use App\Filament\Resources\AgendaDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgendaDesa extends EditRecord
{
    protected static string $resource = AgendaDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
