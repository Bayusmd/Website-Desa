<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerangkatDesaResource\Pages;
use App\Filament\Resources\PerangkatDesaResource\RelationManagers;
use App\Models\PerangkatDesa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{TextInput, FileUpload};
use Filament\Tables\Columns\{ImageColumn, TextColumn};
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Str;

use function Laravel\Prompts\select;

class PerangkatDesaResource extends Resource
{
    protected static ?string $model = PerangkatDesa::class;
    protected static ?string $navigationLabel = 'Perangkat Desa';
    protected static ?string $navigationGroup = 'Perangkat Desa';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form

        ->schema([
            Forms\Components\Hidden::make('Admin_id_admin')
                ->default(fn () => auth('admin')->id()),
            TextInput::make('nama')
                ->required()
                ->maxLength(100),

            Forms\Components\Select::make('jabatan')
                ->required()
                ->options([
                    'Kepala Desa' => 'Kepala Desa',
                    'Sekertaris Desa' => 'Sekertaris Desa',
                    'Kaur TU & Umum' => 'Kaur TU & Umum',
                    'Kaur Perencanaan' => 'Kaur Perencanaan',
                    'Kaur Keuangan' => 'Kaur Keuangan',
                    'Kasi Pemerintahan' => 'Kasi Pemerintahan',
                    'Kasi Pelayanan' => 'Kasi Pelayanan',
                    'Kasi Kesejahteraan' => 'Kasi Kesejahteraan',
                    'Kepala Dusun Patih DlanginLor' => 'Kepala Dusun Patih DlanginLor',
                    'Kepala Dusun Bogangin Nglaban' => 'Kepala Dusun Bogangin Nglaban',
                    'Kepala Dusun Pencil Dlangin Kidul' => 'Kepala Dusun Pencil Dlangin Kidul',
                    'Kepala Dusun Lemahbang' => 'Kepala Dusun Lemahbang',
                    'Kepala Dusun Ngasem' => 'Kepala Dusun Ngasem',
                ]),


            FileUpload::make('foto')
                ->image()
                ->directory('perangkat-desa')
                ->imageEditor()
                ->maxSize(2048)
                 // Placeholder / keterangan
                ->helperText('Unggah foto dalam format PNG, JPG, atau JPEG. Maksimal 2 MB.')

                // Validasi tipe file
                ->acceptedFileTypes([
                    'image/png',
                    'image/jpg',
                    'image/jpeg',
                ])
                ->getUploadedFileNameForStorageUsing(
                    function (TemporaryUploadedFile $file, callable $get) {
                        $jabatan = $get('jabatan');

                        return Str::slug($jabatan) . '.' . $file->getClientOriginalExtension();
                    }
                )
                ->required()
                ->label('Foto Perangkat'),


        ]);


    }

    public static function table(Table $table): Table
    {
        return $table
         ->columns([
             ImageColumn::make('foto')
                 ->circular()
                 ->label('Foto'),

             TextColumn::make('nama')
                 ->searchable()
                 ->sortable(),

             TextColumn::make('jabatan')
                 ->sortable(),
         ])
         ->defaultSort('id', 'asc') // ID terkecil (pertama dibuat) di atas

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
            'index' => Pages\ListPerangkatDesas::route('/'),
            'create' => Pages\CreatePerangkatDesa::route('/create'),
            'edit' => Pages\EditPerangkatDesa::route('/{record}/edit'),
        ];
    }
}
