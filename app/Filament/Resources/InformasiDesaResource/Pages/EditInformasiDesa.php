<?php

namespace App\Filament\Resources\InformasiDesaResource\Pages;

use App\Filament\Resources\InformasiDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInformasiDesa extends EditRecord
{
    protected static string $resource = InformasiDesaResource::class;
    // protected function mutateFormDataBeforeSave(array $data): array
    // {
        // Jika pengguna mengganti gambar → FileUpload memberikan path baru
        // if (!empty($data['gambar'])) {
            // $data['gambar'] = basename($data['gambar']);
        // } else {
            // Jika tidak diganti → gunakan gambar lama
            // $data['gambar'] = $this->record->gambar;
        // }

        // return $data;
    // }





    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
