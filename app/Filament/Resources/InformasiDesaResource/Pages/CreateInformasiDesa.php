<?php

namespace App\Filament\Resources\InformasiDesaResource\Pages;

use App\Filament\Resources\InformasiDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInformasiDesa extends CreateRecord
{
    protected static string $resource = InformasiDesaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Simpan tanggal upload otomatis jika tidak diisi
        if (!isset($data['tanggal_upload'])) {
            $data['tanggal_upload'] = now();
        }

        return $data;
    }


}
