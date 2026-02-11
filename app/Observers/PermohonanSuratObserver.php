<?php

namespace App\Observers;

use App\Models\PermohonanSurat;

class PermohonanSuratObserver
{
    /**
     * Handle the PermohonanSurat "created" event.
     */
    public function created(PermohonanSurat $permohonanSurat): void
    {
        //
    }
     /**
  * Handle the PermohonanSurat "updated" event.
  */
    public function updated(PermohonanSurat $permohonanSurat): void
        {
            // Jika status berubah menjadi selesai
            if (
                $permohonanSurat->isDirty('status_permohonan') &&
                $permohonanSurat->status_permohonan === 'selesai'
            ) {

                // Cek apakah masih ada yang sedang proses
                $masihAdaProses = PermohonanSurat::where('status_permohonan', 'proses')->exists();

                // Jika masih ada yang proses, jangan ubah apa pun
                if ($masihAdaProses) {
                    return;
                }

                // Ambil 1 data berikutnya yang statusnya baru (paling lama)
                $next = PermohonanSurat::where('status_permohonan', 'baru')
                    ->orderBy('tanggal_permohonan', 'asc')
                    ->first();

                if ($next) {
                    $next->update([
                        'status_permohonan' => 'proses'
                    ]);
                }
            }
        }


    /**
     * Handle the PermohonanSurat "deleted" event.
     */
    public function deleted(PermohonanSurat $permohonanSurat): void
    {
        //
    }

    /**
     * Handle the PermohonanSurat "restored" event.
     */
    public function restored(PermohonanSurat $permohonanSurat): void
    {
        //
    }

    /**
     * Handle the PermohonanSurat "force deleted" event.
     */
    public function forceDeleted(PermohonanSurat $permohonanSurat): void
    {
        //
    }
}
