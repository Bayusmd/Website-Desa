<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaDesa extends Model
{
    protected $table = 'agenda_desa';
    protected $primaryKey = 'id_agenda';   // <── INI WAJIB
    public $incrementing = true;
    protected $keyType = 'int';
     protected $fillable = [
        'id_agenda',
        'Admin_id_admin',
        'tanggal_agenda',
        'nama_agenda',
        'lokasi_agenda',
        'deskripsi_agenda',
];
}
