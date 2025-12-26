<?php

namespace App\Filament\Resources\PermohonanSuratResource\Pages;

use App\Filament\Admin\Widgets\PermohonanChart;
use App\Filament\Resources\PermohonanSuratResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\BerkasPermohonan;
use Filament\Notifications\Notification;
use App\Models\Admin;
use Filament\Notifications\Actions\Action;

class CreatePermohonanSurat extends CreateRecord
{
    protected static string $resource = PermohonanSuratResource::class;

    /**
     * Simpan berkas syarat setelah permohonan dibuat
     */
    protected function afterCreate(): void
    {
        $permohonan = $this->record;
        $data = $this->data;

        if (!isset($data['berkas_syarat']) || !is_array($data['berkas_syarat'])) {
            return;
        }

        foreach ($data['berkas_syarat'] as $item) {

            /**
             * Pastikan file_path STRING — bkn array
             */
            if (isset($item['file_path']) && is_array($item['file_path'])) {
                $item['file_path'] = $item['file_path'][0];
            }

            /**
             * Jika file upload baru → ambil dari field file
             */
            if (empty($item['file_path']) && isset($item['file'])) {
                $item['file_path'] = is_array($item['file']) ? $item['file'][0] : $item['file'];
            }

            // Jika tetap kosong → skip
            if (empty($item['file_path'])) {
                continue;
            }

            /**
             * Bersihkan hanya nama file (tanpa folder)
             */
            $filename = basename($item['file_path']);

            BerkasPermohonan::create([
                'Permohonan_surat_id_permohonan' => $permohonan->id_permohonan,
                'nama_berkas' => $item['nama_berkas'],
                'file_path' => $filename,
                'tanggal_upload_berkas' => now(),
            ]);

              $admin = Admin::first();
               if (! $admin) {
                  return; // kalau admin tidak ada, hentikan supaya tidak error
              }
              Notification::make()
                  ->title('Permohonan Baru')
                  ->body('Ada permohonan '. $permohonan->layanan->nama_layanan.' baru yang baru masuk.')
                  ->success()
                  ->actions([
                      Action::make('view')
                          ->button()
                          ->url(PermohonanSuratResource::getUrl('edit', ['record' => $permohonan])),
                        Action::make('markAsRead')
                            ->button()
                            ->markAsRead(),])
                  ->sendToDatabase($admin);
        }
    }
}
