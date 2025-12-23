<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AduanMasyarakat;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use App\Models\Admin;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\AduanMasyarakatResource;

class AduanController extends Controller
{
    public function create()
    {
        return view('aduan.create');
    }

    public function store()

    {
        request()->validate([
            'kategori_aduan' => 'required',
            'deskripsi_aduan' => 'required',
        ]);

         $aduan=AduanMasyarakat::create([
            'kategori_aduan' => request('kategori_aduan'),
            'deskripsi_aduan' => request('deskripsi_aduan'),
            'tanggal_aduan' => now(),
            'status_aduan' => 'baru',
        ]);


         // kirim notif ke admin panel
        $admin = Admin::first();
         if (! $admin) {
            return;
        }
        Notification::make()
            ->title('Aduan Masyarakat Baru')
            ->body('Ada Aduan '.$aduan->kategori_aduan.' dari Masyarakat baru yang baru masuk.')
            ->warning()
            ->actions([
                Action::make('view')
                    ->button()
                    ->url(AduanMasyarakatResource::getUrl('edit', ['record' => $aduan],panel: 'admin')),
                  Action::make('markAsRead')
                      ->button()
                      ->markAsRead(),])
            ->sendToDatabase($admin);

        return redirect()->route('aduan.create')->with('success', 'Aduan berhasil dikirim!');
    }
}
