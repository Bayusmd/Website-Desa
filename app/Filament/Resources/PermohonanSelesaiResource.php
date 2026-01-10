<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermohonanSelesaiResource\Pages;
use App\Filament\Resources\PermohonanSelesaiResource\RelationManagers;
use App\Models\PermohonanSurat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermohonanSelesaiResource extends Resource
{


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }
    protected static ?string $model = PermohonanSurat::class;

    protected static ?string $title = 'Daftar Permohonan Surat Selesai';

    protected static ?string $navigationLabel = 'Permohonan Selesai';
    protected static ?string $navigationIcon = 'heroicon-o-check-circle';
    protected static ?string $navigationGroup = 'Permohonan Surat';
    protected static ?int $navigationSort = 8;


    public static function table(Table $table): Table
    {
        return $table
        // pengatuan agar permohonan surat berstatus selesai tampil
            ->modifyQueryUsing(fn ($query) => $query->where('status_permohonan', 'selesai'))
             ->query(
                    // pengurutan permohonan surat berdasarkan tanggal permohonan yang dahulu diajukan  berdasarkan algoritma fifo
                    PermohonanSurat::query()
                        ->orderBy('tanggal_permohonan', 'asc'))
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('tanggal_permohonan')
                    ->label('Tanggal Permohonan'),
                Tables\Columns\TextColumn::make('layanan.nama_layanan')
                    ->label('Nama Layanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_pemohon')
                    ->label('Nama Pemohon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik_pemohon')
                    ->label('NIK Pemohon'),
                Tables\Columns\TextColumn::make('alamat_pemohon')
                    ->label('Alamat Pemohon'),
                Tables\Columns\TextColumn::make('status_permohonan')
                    ->badge()
                    ->colors([
                        'info' => 'baru',
                        'warning' => 'proses',
                        'success' => 'selesai',
                    ]),
                    Tables\Columns\TextColumn::make('berkas')
                        ->label('Berkas')
                        ->formatStateUsing(function ($state, $record) {
                            if (!$record->berkas || $record->berkas->isEmpty()) {
                                return '-';
                            }
                            return $record->berkas->map(function ($file) {
                                // Bersihkan nama berkas dari whitespace/karakter tidak terlihat
                                $name = preg_replace('/[\x00-\x1F\x7F]/', '', trim($file->nama_berkas));
                                // Hindari error double-slash
                                $path = ltrim($file->file_path, '/');
                                // Buat URL aman menggunakan rawurlencode hanya pada nama file
                                $url = asset('storage/berkas-permohonan/' . rawurlencode($path));
                                // Tampilkan link
                                return "<a href=\"{$url}\"
                                            target=\"_blank\"
                                            class=\"text-blue-600 underline\">
                                            {$name}
                                        </a>";
                            })->implode('<br>');
                        })
                        ->html(),
            ])

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermohonanSelesais::route('/'),
            'create' => Pages\CreatePermohonanSelesai::route('/create'),
            'edit' => Pages\EditPermohonanSelesai::route('/{record}/edit'),
        ];
    }
}
