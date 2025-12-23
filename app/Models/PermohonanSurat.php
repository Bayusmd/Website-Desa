<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\LayananSurat;

class PermohonanSurat extends Model
{
       use HasFactory;

    protected $table = 'permohonan_surat';
    protected $primaryKey = 'id_permohonan';
    public $timestamps = false;

    protected $fillable = [
        'Layanan_surat_id_layanan',
        'nama_pemohon',
        'nik_pemohon',
        'alamat_pemohon',
        'no_whatsapp',
        'email_pemohon',
        'tanggal_permohonan',
        'status_permohonan'
    ];

    /**
     * ===========================================
     *           RELASI MODEL DI SINI
     * ===========================================
     */

    // Relasi ke layanan surat
    public function layanan()
    {
        return $this->belongsTo(LayananSurat::class, 'Layanan_surat_id_layanan');
    }

    // Relasi ke berkas permohonan
public function berkas()
{
    return $this->hasMany(BerkasPermohonan::class, 'Permohonan_surat_id_permohonan', 'id_permohonan');
}

public function berkas_syarat()
{
    return $this->hasMany(BerkasPermohonan::class, 'permohonan_surat_id_permohonan');
}

}
