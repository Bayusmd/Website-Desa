<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'Admin_id_admin',
        'judul',
        'isi',
        'foto'

    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'Admin_id_admin', 'id');

    }
}

