<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerkasPermohonan extends Model
{
    protected $table = 'berkas_permohonan';

    protected $primaryKey = 'id_berkas';

    public $timestamps = false;

    protected $fillable = [
        'nama_berkas',
        'file_path',
        'tanggal_upload_berkas',
        'Permohonan_surat_id_permohonan'
    ];





    public function permohonan()
{
    return $this->belongsTo(PermohonanSurat::class, 'Permohonan_surat_id_permohonan', 'id_permohonan');
}

}
