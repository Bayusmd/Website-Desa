<?php

namespace App\Filament\Resources\AduanMasyarakatResource\Pages;

use App\Filament\Resources\AduanMasyarakatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
 use Filament\Resources\Components\Tab;
 use Illuminate\Database\Eloquent\Builder;

class ListAduanMasyarakats extends ListRecords
{
    protected static string $resource = AduanMasyarakatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }



public function getTabs(): array
{
    return [
        'aktif' => Tab::make('Aduan Baru & Proses')
            ->modifyQueryUsing(function (Builder $query) {
                $query->whereIn('status_aduan', ['baru', 'proses'])
                      ->orderBy('tanggal_aduan', 'asc');
            }),

        'selesai' => Tab::make('Aduan Selesai')
            ->modifyQueryUsing(function (Builder $query) {
                $query->where('status_aduan', 'selesai')
                      ->orderBy('tanggal_aduan', 'asc');
            }),
    ];
}
}
