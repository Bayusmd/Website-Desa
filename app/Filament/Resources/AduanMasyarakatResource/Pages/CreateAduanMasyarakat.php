<?php

namespace App\Filament\Resources\AduanMasyarakatResource\Pages;

use App\Filament\Resources\AduanMasyarakatResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use App\Models\Admin;
use Filament\Notifications\Actions\Action;


class CreateAduanMasyarakat extends CreateRecord
{
    protected static string $resource = AduanMasyarakatResource::class;
    protected function afterCreate(): void
    {
         $aduan = $this->record;
         $admin = Admin::first();
      if (! $admin) {
         return; // kalau admin tidak ada, hentikan supaya tidak error
     }
     Notification::make()
         ->title('Aduan Masyarakat Baru')
         ->body('Ada Aduan Masyarakat baru yang baru masuk.')
         ->warning()
         ->actions([
             Action::make('view')
                 ->button()
                 ->url(AduanMasyarakatResource::getUrl('edit', ['record' => $aduan])),
               Action::make('markAsRead')
                   ->button()
                   ->markAsRead(),])
         ->sendToDatabase($admin);
    }

}
