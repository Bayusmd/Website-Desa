<?php

namespace App\Filament\Resources\PermohonanSelesaiResource\Pages;

use App\Filament\Resources\PermohonanSelesaiResource;
use App\Models\BerkasPermohonan;
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
    protected function mutateFormDataBeforeFill(array $data): array
        {
            // Ambil semua berkas dari DB untuk permohonan ini
            $berkas = \App\Models\BerkasPermohonan::where(
                'Permohonan_surat_id_permohonan',
                $this->record->id_permohonan
            )->get();
            $data['berkas_syarat'] = $berkas->map(function ($item) {
                return [
                    'nama_berkas' => $item->nama_berkas,
                    'file'        => 'berkas-permohonan/' . $item->file_path, // PREVIEW MUNCUL
                    'file_path'   => $item->file_path,
                ];
            })->toArray();
            return $data;
        }
    /**
     * Update berkas setelah edit
     */
    protected function afterSave(): void
    {
        $permohonan = $this->record;
        $data = $this->data;
        if (!isset($data['berkas_syarat']) || !is_array($data['berkas_syarat'])) {
            return;
        }
        foreach ($data['berkas_syarat'] as $item) {
            // Pastikan berkas ada datanya
            if (!isset($item['id'])) {
                continue;
            }
            $berkas = BerkasPermohonan::find($item['id']);
            if (!$berkas) {
                continue;
            }
            /**
             * Jika file TIDAK diganti → gunakan filename lama
             */
            if (empty($item['file']) && empty($item['file_path'])) {
                continue;
            }
            /**
             * Jika file diganti → update file_path dg nama file baru
             */
            if (!empty($item['file_path'])) {
                $berkas->update([
                    'file_path' => basename($item['file_path']),
                ]);
            }
        }
    }
}
