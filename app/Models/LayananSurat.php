<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananSurat extends Model
{
    protected $table = 'layanan_surat';
     protected $primaryKey = 'id_layanan'; // ← GANTI DENGAN NAMA PK YANG BENAR
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
    'id_layanan',
    'Admin_id_admin',
    'nama_layanan',
    'deskripsi_layanan',
    'tanggal_dibuat',];

    public function syarat()
{
    return $this->hasMany(\App\Models\SyaratSurat::class, 'Layanan_surat_id_layanan');
}

}
