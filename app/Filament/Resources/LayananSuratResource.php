<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananSuratResource\Pages;
use App\Filament\Resources\LayananSuratResource\RelationManagers;
use App\Models\LayananSurat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class LayananSuratResource extends Resource
{
    protected static ?string $model = LayananSurat::class;

    protected static ?string $navigationLabel = 'Jenis Layanan Surat';
    protected static ?string $navigationGroup = 'Layanan Surat';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('Admin_id_admin')
                    ->default(fn () => auth('admin')->id()),
                Forms\Components\TextInput::make('nama_layanan')
                    ->label('Nama Layanan Surat')
                    ->placeholder('Masukkan Nama Layanan Surat')
                    ->required()
                    ->maxLength(45),
                Forms\Components\TextInput::make('deskripsi_layanan')
                    ->label('Deskripsi Layanan Surat')
                    ->placeholder('Masukkan Deskripsi Layanan Surat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_dibuat')
                    ->default(now())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                // Tables\Columns\TextColumn::make('id_layanan')
                    // ->numeric()
                    // ->sortable(),
                Tables\Columns\TextColumn::make('nama_layanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi_layanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_dibuat')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('syarat.nama_syarat')
                    ->label('Syarat')
                    ->listWithLineBreaks()   // tampil bertingkat
                    ->limit(30)
                    ->toggleable(),
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
            'index' => Pages\ListLayananSurats::route('/'),
            'create' => Pages\CreateLayananSurat::route('/create'),
            'edit' => Pages\EditLayananSurat::route('/{record}/edit'),
        ];
    }
}
