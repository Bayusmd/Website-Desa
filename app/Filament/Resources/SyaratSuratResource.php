<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SyaratSuratResource\Pages;
use App\Filament\Resources\SyaratSuratResource\RelationManagers;
use App\Models\SyaratSurat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SyaratSuratResource extends Resource
{
    protected static ?string $model = SyaratSurat::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
    protected static ?string $navigationLabel = 'syarat Layanan Surat';
    protected static ?string $navigationGroup = 'Layanan Surat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('Layanan_surat_id_layanan')
                ->label('Nama Layanan')
                ->relationship('layanan', 'nama_layanan')  
                ->searchable()
                ->preload()
                ->required(),
                Forms\Components\TextInput::make('nama_syarat')
                    ->required()
                    ->maxLength(45),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                // Tables\Columns\TextColumn::make('id_syarat')
                    // ->numeric()
                    // ->sortable(),
                Tables\Columns\TextColumn::make('layanan.nama_layanan')
                    ->label('Nama Layanan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_syarat')
                    ->searchable(),
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
            'index' => Pages\ListSyaratSurats::route('/'),
            'create' => Pages\CreateSyaratSurat::route('/create'),
            'edit' => Pages\EditSyaratSurat::route('/{record}/edit'),
        ];
    }
}
