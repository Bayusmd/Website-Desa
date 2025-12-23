<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AduanMasyarakat extends Model
{
    protected $table = 'aduan_masyarakat';
    protected $primaryKey = 'id_aduan';
    public $incrementing = true;
    protected $keyType = 'int';
     protected $fillable = [
        'Admin_id_admin',
        'kategori_aduan',
        'deskripsi_aduan',
        'tanggal_aduan',
        'status_aduan',
    ];
}
