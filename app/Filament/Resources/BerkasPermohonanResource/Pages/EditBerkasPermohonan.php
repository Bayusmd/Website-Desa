<?php

namespace App\Filament\Resources\BerkasPermohonanResource\Pages;

use App\Filament\Resources\BerkasPermohonanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBerkasPermohonan extends EditRecord
{
    protected static string $resource = BerkasPermohonanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
     protected function mutateFormDataBeforeFill(array $data): array
    {
        if (!empty($data['file_path'])) {
            // FileUpload butuh path relatif dari disk
            $data['file_path'] = 'storage/berkas-permohonan/' . $data['file_path'];
        }

        return $data;
    }

    /**
     * ⬇️ Jaga agar file lama tidak hilang jika tidak upload ulang
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Jika user tidak upload ulang
        if (is_string($data['file_path'])) {
            // Ambil nama file saja
            $data['file_path'] = basename($data['file_path']);
        }

        return $data;
    }

}
