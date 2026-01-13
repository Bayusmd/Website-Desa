<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermohonanSuratResource\Pages;
use App\Models\PermohonanSurat;
use App\Models\SyaratSurat;
use App\Models\BerkasPermohonan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Symfony\Contracts\Service\Attribute\Required;

class PermohonanSuratResource extends Resource
{
    protected static ?string $model = PermohonanSurat::class;

    protected static ?string $navigationLabel = 'Permohonan Surat';
    protected static ?string $navigationGroup = 'Permohonan Surat';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?int $navigationSort = 7;




    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                /*
                |--------------------------------------------------------------------------
                | PILIH LAYANAN
                |--------------------------------------------------------------------------
                */
                Forms\Components\Select::make('Layanan_surat_id_layanan')
                    ->label('Pilih Layanan')
                    ->relationship('layanan', 'nama_layanan')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {

                        // Ambil syarat berdasarkan layanan
                        $syarat = SyaratSurat::where('Layanan_surat_id_layanan', $state)
                            ->get()
                            ->map(fn ($item) => [
                                'nama_berkas' => $item->nama_syarat,
                                'file' => null,
                            ])
                            ->toArray();

                        $set('berkas_syarat', $syarat);
                    }),



                /*
                |--------------------------------------------------------------------------
                | DATA PEMOHON
                |--------------------------------------------------------------------------
                */
                Forms\Components\TextInput::make('nama_pemohon')
                    ->required()
                    ->label('Nama Pemohon')
                    ->placeholder('Masukkan nama lengkap pemohon')
                    ->minLength(3)
                    ->maxLength(45) // Validasi minimal 3 karakter
                    ->regex('/^[a-zA-Z\s]*$/') // Hanya huruf (a-z, A-Z) dan spasi (\s)
                    ->validationMessages([
                        'regex' => 'Nama pemohon hanya boleh berisi huruf dan spasi.',
                        'min' => 'Nama pemohon minimal harus 3 karakter.',
                    ]),

                Forms\Components\TextInput::make('nik_pemohon')
                    ->required()
                    ->label('NIK Pemohon')
                    ->numeric()
                    ->length(16)
                    ->placeholder('Masukkan NIK (16 digit)')
                    ->rule('regex:/^[0-9]{16}$/')
                    ->validationMessages([
                        'required' => 'NIK wajib diisi.',
                        'numeric'  => 'NIK hanya boleh berisi angka.',
                        'length'   => 'NIK harus terdiri dari 16 digit.',
                        'regex'    => 'Format NIK tidak valid.',
                    ]),


                Forms\Components\TextInput::make('alamat_pemohon')
                    ->label('Alamat Pemohon')
                    ->placeholder('Masukkan alamat lengkap (Dusun, RT/RW)')
                    ->maxLength(45)
                    ->required()
                    ->helperText('Contoh: Dusun Patih RT 01 / RW 01'),

                Forms\Components\TextInput::make('no_whatsapp')
                    ->required()
                    ->label('No Whatsapp Pemohon')
                    ->tel()
                    ->placeholder('Contoh: 081234567890')
                    ->rule('regex:/^(08|628)[0-9]{9,15}$/')
                    ->validationMessages([
                        'required' => 'Nomor WhatsApp wajib diisi.',
                        'regex'    => 'Gunakan format 08xxxxxxxxxx atau 628xxxxxxxxxx.',
                    ])
                    ->helperText('Gunakan format 08xxxxxxxxxx atau 628xxxxxxxxxx'),



                Forms\Components\TextInput::make('email_pemohon')
                    ->label('Email Pemohon')
                    ->email()
                    ->required()
                    ->placeholder('contoh@gmail.com')
                    ->maxLength(50)
                    ->helperText('Masukkan alamat email aktif')
                    ->validationMessages([
                        'required' => 'Email wajib diisi.',
                        'email'    => 'Format email tidak valid.',
                        'max'      => 'Email maksimal 50 karakter.',
                    ])
                    // Hindari spasi di awal/akhir
                    ->dehydrateStateUsing(fn ($state) => trim($state)),

                Forms\Components\DateTimePicker::make('tanggal_permohonan')
                    ->default(now())
                    ->helperText('Tanggal dan waktu permohonan dibuat')
                    ->required(),

                Forms\Components\Select::make('status_permohonan')
                    ->options([
                        'baru' => 'Baru',
                        'proses' => 'Diproses',
                        'selesai' => 'Selesai',
                    ])
                    ->default('baru'),

                 /*
                |--------------------------------------------------------------------------
                | UPLOAD FILE PER SYARAT (DINAMIS)
                |--------------------------------------------------------------------------
                */
                Forms\Components\Repeater::make('berkas_syarat')
                    ->schema([
                        Forms\Components\TextInput::make('nama_berkas')
                            ->disabled(),
                        Forms\Components\FileUpload::make('file')
                            ->label('Upload File')
                            ->disk('public')
                            ->directory('berkas-permohonan')
                            ->preserveFilenames()
                            ->visibility('public')
                            ->imageEditor()
                            ->required()
                            ->maxSize(2048)
                               // Placeholder / keterangan
                            ->helperText('Unggah foto dalam format PNG, JPG, atau JPEG. Maksimal 2 MB.')
                            // Validasi tipe file
                            ->acceptedFileTypes([
                                'image/png',
                                'image/jpg',
                                'image/jpeg',
                            ])
                            ->getUploadedFileNameForStorageUsing(function ($file) {
                                return $file->getClientOriginalName();
                            })
                             ->storeFileNamesIn('file_path')
                             ->default(function ($record, $context) {
                                    if ($context !== 'edit' || !$record) return null;

                                    // Jika record punya relasi 'berkas'
                                    if (!isset($record->berkas)) return null;

                                    // Cari berkas berdasarkan nama syarat
                                    $item = $record->berkas->firstWhere('nama_berkas', request()->query('item'));

                                    if (!$item) return null;

                                    return 'berkas-permohonan/' . $item->file_path;
                                })
                            ->afterStateUpdated(function ($state, callable $set) {
                                // Pastikan hanya string yang masuk
                                if (is_array($state)) {
                                    $state = $state[0];
                                }
                                $set('file_path', $state);
                            }),
                        Forms\Components\Hidden::make('file_path'),
                    ])
                    ->default([])
                    ->columns(1)





            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
           // pengatuan agar permohonan surat berstatus baru dan proses tampil
            ->modifyQueryUsing(fn ($query) =>$query->whereIn('status_permohonan', ['baru', 'proses']))
             ->query(
                // pengurutan permohonan surat berdasarkan tanggal permohonan yang dahulu diajukan  berdasarkan algoritma fifo
                PermohonanSurat::query()
                    ->orderBy('tanggal_permohonan', 'asc'))
                    // ->defaultSort('status_permohonan')    // selesai paling bawah
                    // ->defaultSort('tanggal_permohonan', 'asc')    // tanggal awal → akh
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
                                return
                                "
                                    <div class=\"flex items-center gap-3\">

                                        <!-- Preview -->
                                        <a href=\"{$url}\"
                                           target=\"_blank\"
                                           class=\"text-blue-600 hover:text-blue-800 underline \">
                                           👁 Preview
                                        </a>

                                        <!-- Download -->
                                        <a href=\"{$url}\"
                                           download
                                           class=\"text-green-600 hover:text-green-800 underline\">
                                           ⬇ Download
                                        </a>

                                        <span class=\"text-gray-500 text-xs\">
                                            ({$name})
                                        </span>

                                    </div>
                                ";

                            })->implode('<br>');
                        })
                        ->html(),


            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermohonanSurats::route('/'),
            'create' => Pages\CreatePermohonanSurat::route('/create'),
            'edit' => Pages\EditPermohonanSurat::route('/{record}/edit'),
        ];
    }
}
