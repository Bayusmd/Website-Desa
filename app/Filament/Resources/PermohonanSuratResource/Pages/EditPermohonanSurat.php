<?php

namespace App\Filament\Resources\PermohonanSuratResource\Pages;

use App\Filament\Resources\PermohonanSuratResource;
use Filament\Resources\Pages\EditRecord;
use App\Models\BerkasPermohonan;
use Filament\Actions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EditPermohonanSurat extends EditRecord
{
    protected static string $resource = PermohonanSuratResource::class;
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
           $record = $this->record;

    if ($record->wasChanged('status_permohonan') &&
        $record->status_permohonan === 'selesai') {

        $nomor = preg_replace('/^0/', '62', $record->no_whatsapp);
        $layanan = optional($record->layanan)->nama_layanan ?? 'Surat';
        $tanggal = \Carbon\Carbon::parse($record->tanggal_permohonan)
            ->translatedFormat('d F Y H:i');

        $pesan = "Halo {$record->nama_pemohon},\n\n"
            . "Permohonan *{$layanan}* Anda telah *SELESAI*.\n\n"
            . "Detail Permohonan:\n"
            . "Nama: *{$record->nama_pemohon}*\n"
            . "Layanan: *{$layanan}*\n"
            . "Tanggal Diajukan: *{$tanggal}*\n"
            . "ID Permohonan: *{$record->id_permohonan}*\n\n"
            . "Silakan diambil di Kantor Desa Lemahbang pada Jam Kerja.\n"
            . "Senin-Kamis 07.30-15.00.\n"
            . "Jumat 07.30-11.30.\n\n"
            . "Terima kasih.\n\n"
            . "Hormat Kami Pemerintah Desa Lemahbang.\n";

        $response = Http::withHeaders([
            'Authorization' => config('services.fonnte.token'),
        ])->asForm()->post('https://api.fonnte.com/send', [
            'target'  => $nomor,
            'message' => $pesan,
        ]);

        Log::info('Fonnte Response: ' . $response->body());
    }
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
    protected function authorizeAccess(): void
    {
        parent::authorizeAccess();

        $record = $this->record;

        $blocked = \App\Models\PermohonanSurat::where('tanggal_permohonan', '<', $record->tanggal_permohonan)
            ->where('status_permohonan', '!=', 'selesai')
            ->exists();

        if ($blocked) {
            abort(403, 'Tidak bisa mengedit karena masih ada permohonan lebih lama yang belum selesai.');
        }
    }

}
