<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformasiDesaResource\Pages;
use App\Filament\Resources\InformasiDesaResource\RelationManagers;
use App\Models\InformasiDesa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InformasiDesaResource extends Resource
{
    protected static ?string $model = InformasiDesa::class;

    protected static ?string $navigationIcon = 'heroicon-o-window';
    protected static ?string $navigationLabel = 'Informasi Desa';
    protected static ?string $navigationGroup = 'Informasi Desa';
    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('Admin_id_admin')
                    ->default(fn () => auth('admin')->id()),
                Forms\Components\Select::make('kategori')
                    ->options([
                        'keuangan' => 'Keuangan',
                        'pemerintahan' => 'Pemerintahan',
                        'kesehatan' => 'Kesehatan',
                        'geografis' => 'Geografis',
                        'layanan' => 'Layanan',
                        'lain-lain' => 'Lain-lain',
                    ]),

                Forms\Components\TextInput::make('judul')
                    ->placeholder('Masukkan Judul Informasi Desa')
                    ->required()
                    ->maxLength(45),
                Forms\Components\Textarea::make('deskripsi')
                    ->placeholder('Masukkan Deskripsi Lengkap Informasi Desa')
                    ->required()
                    ->rows(8)
                    ->maxLength(255),
                Forms\Components\FileUpload::make('gambar')
                    ->label('Upload Gambar')
                    ->disk('public')
                    ->directory('gambar')
                    ->preserveFilenames()
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->maxSize(2048)
                    ->imagePreviewHeight('150')
                    ->openable()
                    ->downloadable()
                    // Placeholder / keterangan
                    ->helperText('Unggah foto dalam format PNG, JPG, atau JPEG. Maksimal 2 MB.')
                    // Validasi tipe file
                    ->acceptedFileTypes([
                        'image/png',
                        'image/jpg',
                        'image/jpeg',
                    ])
                    ->required(fn($record) => $record === null)
                    ->getUploadedFileNameForStorageUsing(fn($file) => $file->getClientOriginalName())
                    ,

                Forms\Components\DateTimePicker::make('tanggal_upload')
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
                // Tables\Columns\TextColumn::make('id_informasi')
                    // ->numeric()
                    // ->sortable(),
                Tables\Columns\TextColumn::make('kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('judul')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->disk('public')
                    ->height(60)
                    ->square()
                    ->url(fn ($record) => asset('storage/' . $record->gambar))
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('tanggal_upload')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListInformasiDesas::route('/'),
            'create' => Pages\CreateInformasiDesa::route('/create'),
            'edit' => Pages\EditInformasiDesa::route('/{record}/edit'),
        ];
    }
}
