<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = [
        'Admin_id_admin',
        'judul',
        'deskripsi',
        'gambar',
    ];
}
