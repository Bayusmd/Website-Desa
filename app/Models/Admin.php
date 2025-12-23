<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable implements FilamentUser
{
    use Notifiable;

    protected $table = 'admin';             // sesuaikan: 'admins' atau 'admin'
    protected $primaryKey = 'id';     // sesuaikan nama PK
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_admin',
        'email',   // jika kolommu email_admin
        'password',      // gunakan 'password' agar kompatibel, atau lihat getAuthPassword() di bawah
    ];

    protected $hidden = [
        'password',
    ];

    // jika kolom email bernama email_admin, override identifier:
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getNameAttribute()
    {
        return $this->nama_admin ?? 'Admin';
    }

    public function getFilamentName(): string
    {
    return $this->nama_admin ?? 'Admin';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Berikan akses true agar admin bisa masuk ke dashboard
        return true;
    }
    // jika kolom password bernama bukan 'password' (mis. password_admin), override:
    // public function getAuthPassword()
    // {
    //     return $this->password_admin;
    // }
}
