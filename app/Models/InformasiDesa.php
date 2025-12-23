<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiDesa extends Model
{
    protected $table = 'informasi_desa';
    protected $primaryKey = 'id_informasi';   // <── INI WAJIB
    public $incrementing = true;
    protected $keyType = 'int';
    protected $casts = [
    'gambar' => 'string',
    ];

    protected $fillable = [
        'Admin_id_admin',
            'kategori',
            'judul',
            'deskripsi',
            'gambar',
            'tanggal_upload',
    ];
}
