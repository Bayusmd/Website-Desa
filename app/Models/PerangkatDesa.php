<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerangkatDesa extends Model
{
     protected $table = 'perangkat_desa';

    protected $fillable = [
        'Admin_id_admin',
        'nama',
        'jabatan',
        'foto',
    ];
}
