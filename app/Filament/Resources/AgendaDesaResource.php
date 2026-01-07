<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendaDesaResource\Pages;
use App\Filament\Resources\AgendaDesaResource\RelationManagers;
use App\Models\AgendaDesa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgendaDesaResource extends Resource
{
    protected static ?string $model = AgendaDesa::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Agenda Desa';
    protected static ?string $navigationGroup = 'Informasi Desa';
    protected static ?int $navigationSort = 3;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('Admin_id_admin')
                    ->default(fn () => auth('admin')->id()),
                Forms\Components\DatePicker::make('tanggal_agenda')
                    ->required(),
                Forms\Components\TextInput::make('nama_agenda')
                    ->placeholder('Tuliskan nama agenda')
                    ->required()
                    ->maxLength(45),
                Forms\Components\TextInput::make('lokasi_agenda')
                    ->placeholder('Tuliskan lokasi agenda akan di laksanakan')
                    ->required()
                    ->maxLength(45),
                Forms\Components\Textarea::make('deskripsi_agenda')
                    ->placeholder('Tuliskan deskripsi agenda secara lengkap')
                    ->required()
                    ->rows(8)
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                // Tables\Columns\TextColumn::make('Admin_id_admin')
                    // ->numeric()
                    // ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_agenda')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_agenda')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lokasi_agenda')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi_agenda')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListAgendaDesas::route('/'),
            'create' => Pages\CreateAgendaDesa::route('/create'),
            'edit' => Pages\EditAgendaDesa::route('/{record}/edit'),
        ];
    }
}
