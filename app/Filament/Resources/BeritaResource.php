<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeritaResource\Pages;
use App\Filament\Resources\BeritaResource\RelationManagers;
use App\Models\Berita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static ?string $navigationGroup = 'Berita Desa';
    protected static ?string $navigationLabel = 'Berita Desa';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('Admin_id_admin')
                    ->default(fn () => auth('admin')->id()),

                Forms\Components\TextInput::make('judul')
                    ->placeholder('Tuliskan Judul Berita')
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->directory('berita')
                    ->imageEditor()
                    ->maxSize(2048)
                    ->imagePreviewHeight('200')
                    ->acceptedFileTypes([
                        'image/png',
                        'image/jpg',
                        'image/jpeg',
                    ])
                    ->helperText('Upload gambar JPG/JPEG/PNG maksimal 2 MB')
                    ->required(),

                Forms\Components\RichEditor::make('isi')
                    ->placeholder('Tuliskan Isi Berita')
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
                Tables\Columns\ImageColumn::make('foto')
                    ->circular(),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('admin.name')
                    ->label('Diposting oleh'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d M Y'),
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
            'index' => Pages\ListBeritas::route('/'),
            'create' => Pages\CreateBerita::route('/create'),
            'edit' => Pages\EditBerita::route('/{record}/edit'),
        ];
    }
}
