<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriResource\Pages;
use App\Filament\Resources\GaleriResource\RelationManagers;
use App\Models\Galeri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GaleriResource extends Resource
{
    protected static ?string $model = Galeri::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Galeri Desa';
    protected static ?string $navigationGroup = 'Galeri Desa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('Admin_id_admin')
                    ->default(fn () => auth('admin')->id()),
                Forms\Components\TextInput::make('judul')
                    ->placeholder('Tuliskan judul gambar')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('deskripsi')
                    ->placeholder('Tuliskan deskripsi gambar jika perlu.....')
                    ->rows(3),

                Forms\Components\FileUpload::make('gambar')
                    ->required()
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('galeri-desa')
                    ->maxSize(2048)
                    ->imagePreviewHeight('200')
                    ->acceptedFileTypes([
                        'image/png',
                        'image/jpg',
                        'image/jpeg',
                    ])
                    ->helperText('Upload gambar JPG/JPEG/PNG maksimal 2 MB'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    Tables\Columns\TextColumn::make('no')
                        ->label('No')
                        ->rowIndex(),
                    Tables\Columns\ImageColumn::make('gambar')
                        ->label('Foto')
                        ->square(),

                    Tables\Columns\TextColumn::make('judul')
                        ->searchable()
                        ->sortable(),

                    Tables\Columns\TextColumn::make('created_at')
                        ->label('Tanggal')
                        ->date(),
            ])
            ->defaultSort('created_at', 'desc')

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
            'index' => Pages\ListGaleris::route('/'),
            'create' => Pages\CreateGaleri::route('/create'),
            'edit' => Pages\EditGaleri::route('/{record}/edit'),
        ];
    }
}
