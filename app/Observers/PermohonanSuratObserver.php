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
        if ($permohonanSurat->isDirty('status_permohonan') && $permohonanSurat->status_permohonan === 'selesai') {

            // Cari permohonan berikutnya yang paling lama dan masih 'baru'
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
