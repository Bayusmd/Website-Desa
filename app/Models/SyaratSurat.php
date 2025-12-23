<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyaratSurat extends Model
{
    protected $table = 'syarat_surat';
     protected $primaryKey = 'id_syarat';

    protected $fillable = [
        'Layanan_surat_id_layanan',
        'nama_syarat',
    ];

    public function layanan()
{
    return $this->belongsTo(LayananSurat::class, 'Layanan_surat_id_layanan');
}
}
