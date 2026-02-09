<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BerkasPermohonanResource\Pages;
use App\Filament\Resources\BerkasPermohonanResource\RelationManagers;
use App\Models\BerkasPermohonan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BerkasPermohonanResource extends Resource
{
    protected static ?string $model = BerkasPermohonan::class;
    protected static ?string $navigationLabel = 'Berkas Permohonan Surat';
    protected static ?string $navigationGroup = 'Permohonan Surat';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 9;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('nama_berkas')
                    // ->required()
                    // ->maxLength(20),
                // Forms\Components\FileUpload::make('file_path')
                    // ->disk('public')
                    // ->directory('berkas-permohonan')
                    // ->preserveFilenames()
                    // ->visibility('public')
                    // ->imageEditor()
                    // ->image()
                    // ->required(false) // ⬅️ TIDAK WAJIB upload ulang
                    // ->helperText('Biarkan kosong jika tidak ingin mengganti file'),
                // Forms\Components\DatePicker::make('tanggal_upload_berkas')
                    // ->required(),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('Permohonan_surat_id_permohonan')
                    ->label('Id Permohonan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('permohonan.nama_pemohon')
                    ->label('Nama Pemohon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_berkas')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file_path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_upload_berkas')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBerkasPermohonans::route('/'),
            'create' => Pages\CreateBerkasPermohonan::route('/create'),
            'edit' => Pages\EditBerkasPermohonan::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
    return false;
    }

}
