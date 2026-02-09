<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AduanMasyarakatResource\Pages;
use App\Filament\Resources\AduanMasyarakatResource\RelationManagers;
use App\Models\AduanMasyarakat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AduanMasyarakatResource extends Resource
{
    protected static ?string $model = AduanMasyarakat::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';
    protected static ?string $navigationLabel = 'Aduan Masyarakat';
    protected static ?string $navigationGroup = 'Aduan Masyarakat';
    protected static ?int $navigationSort = 5;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('Admin_id_admin')
                    ->default(fn () => auth('admin')->id()),
                Forms\Components\TextInput::make('kategori_aduan')

                    ->readOnly() // TextInput mendukung metode ini
                    ->formatStateUsing(fn ($state) => match($state) {
                        'infrastruktur' => 'Infrastruktur',
                        'pemerintahan' => 'Pemerintahan',
                        'lingkungan' => 'Lingkungan',
                        'kesehatan' => 'Kesehatan',
                        'keamanan' => 'Keamanan',
                        'pelayanan' => 'Pelayanan',
                        'keuangan' => 'Keuangan',
                        'lainnya' => 'Lainnya',
                        default => $state,
                    }),
                    // ->options([
                            // 'infrastruktur' => 'Infrastruktur',
                            // 'pemerintahan' => 'Pemerintahan',
                            // 'kesehatan' => 'Kesehatan',
                            // 'kambitbmas' => 'Kamtibmas',
                            // 'pelayanan' => 'Pelayanan',
                            // 'lain-lain' => 'Lain-lain',
                        // ])
                    // ->disabled()
                    // ->dehydrated(true)
                    // ->readOnly(),
                Forms\Components\TextInput::make('deskripsi_aduan')
                    ->required()
                    ->maxLength(255)
                    ->readOnly(),
                Forms\Components\DatePicker::make('tanggal_aduan')
                    ->default(now())
                    ->required()
                    ->disabled(),
                Forms\Components\Select::make('status_aduan')
                    ->options([
                    'baru' => 'Baru',
                    'proses' => 'Diproses',
                    'selesai' => 'Selesai',
                    ])
                    ->default('baru'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
                 ->query(
                        AduanMasyarakat::query()
                            ->orderByRaw("
                                CASE
                                    WHEN status_aduan = 'selesai' THEN 2
                                    ELSE 1
                                END
                            ")
                            ->orderBy('tanggal_aduan', 'asc') // urutan
                    )
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                // Tables\Columns\TextColumn::make('id_aduan')
                    // ->numeric()
                    // ->sortable(),
                Tables\Columns\TextColumn::make('kategori_aduan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi_aduan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_aduan')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_aduan')
                    ->badge()
                    ->colors([
                    'info' => 'baru',
                    'warning' => 'proses',
                    'success' => 'selesai',
                     ]),
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
            'index' => Pages\ListAduanMasyarakats::route('/'),
            'create' => Pages\CreateAduanMasyarakat::route('/create'),
            'edit' => Pages\EditAduanMasyarakat::route('/{record}/edit'),
        ];
    }
}
