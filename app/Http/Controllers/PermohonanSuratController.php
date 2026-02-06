<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LayananSurat;
use App\Models\PermohonanSurat;
use App\Models\BerkasPermohonan;
use App\Helpers\WhatsAppHelper;
use App\Jobs\KirimWaPermohonanSelesai;
use \App\Models\SyaratSurat;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use App\Models\Admin;
use App\Filament\Resources\PermohonanSuratResource;

class PermohonanSuratController extends Controller
{
    public function index()
    {
        $q = request('q');

        $layanan = LayananSurat::when($q, function ($query, $q) {
            $query->where('nama_layanan', 'like', "%{$q}%")
                  ->orWhere('deskripsi_layanan', 'like', "%{$q}%");
        })->get();

        return view('permohonan.index', compact('layanan'));
        // return view('permohonan.index', [
            // 'layanan' => LayananSurat::all()
        // ]);
    }

    public function create($id)
    {
        return view('permohonan.create', [
            'layanan' => LayananSurat::findOrFail($id)
        ]);
    }

    public function store()
    {
        request()->validate([
            'Layanan_surat_id_layanan' => 'required',
            'nama_pemohon'  => [
                    'required',
                    'string',
                    'min:3',
                    'max:45',
                    'max:100',
                    'regex:/^[a-zA-Z\s\.\']+$/'
                    ],
            'nik_pemohon' => [
                'required',
                'numeric',
                'digits:16'],
            'alamat_pemohon' => [
                'required',
                'max:45'],
            'no_whatsapp' => [
                    'required',
                    'regex:/^(08|628)[0-9]{9,15}$/'
                ],
             'email_pemohon' => [
                    'required',
                    'email',
                    'max:100'
                ],
            'berkas'   => ['required', 'array'],
            'berkas.*' => 'required|file|mimes:jpg,jpeg,png|max:2048'
            ],
         [ // CUSTOM MESSAGES
            'nik_pemohon.digits' => 'NIK harus berjumlah 16 digit.',
            'nik_pemohon.required' => 'NIK harus di isi dan  berjumlah 16 digit.',

            'nama_pemohon.required' => 'Nama pemohon wajib diisi.',
            'nama_pemohon.min' => 'Nama pemohon minimal 3 karakter.',
            'nama_pemohon.max' => 'Nama pemohon maksimal 45 karakter.',
            'nama_pemohon.regex' => 'Nama hanya boleh berisi huruf dan spasi.',

            'email_pemohon.required' => 'Email pemohon wajib diisi.',
            'email_pemohon.email' => 'Format email tidak valid.',
            'email_pemohon.max' => 'Email maksimal 100 karakter.',

            'alamat_pemohon.max' => 'Alamat pemohon maksimal 45 karakter.',

            'no_whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'no_whatsapp.regex' => 'Nomor WhatsApp harus diawali 08 atau 628 dan hanya angka.',

            'berkas.*.max'       => 'Ukuran file tidak boleh lebih dari 2MB.',
            'berkas.*.mimes'     => 'Hanya file gambar (JPG, JPEG, PNG) yang diperbolehkan!',
            'berkas.*.required'  => 'Harus menggunggah File yang diminta.'
        ]);

        $permohonan = PermohonanSurat::create([
            'Layanan_surat_id_layanan' => request('Layanan_surat_id_layanan'),
            'nama_pemohon' => request('nama_pemohon'),
            'nik_pemohon' => request('nik_pemohon'),
            'alamat_pemohon' => request('alamat_pemohon'),
            'no_whatsapp' => request('no_whatsapp'),
            'email_pemohon' => request('email_pemohon'),
            'tanggal_permohonan' => now(),
            'status_permohonan' => 'baru',
        ]);

        foreach (request('berkas') as $idSyarat => $file ) {

            $syarat = SyaratSurat::findOrFail($idSyarat);

           $namaAsli = $file->getClientOriginalName();
            $file->storeAs(
                    'berkas-permohonan',
                    $namaAsli,
                    'public'
                    );


            BerkasPermohonan::create([
                'Permohonan_surat_id_permohonan' => $permohonan->id_permohonan,
                'nama_berkas' => $syarat->nama_syarat,
                'file_path' => $namaAsli,
                'tanggal_upload_berkas' => now(),
            ]);
        }
        // kirim notif ke admin panel
        $admin = Admin::first();
         if ($admin) {
        Notification::make()
            ->title('Permohonan Baru')
            ->body('Ada permohonan layanan '. $permohonan->layanan->nama_layanan.' baru yang baru masuk.')
            ->success()
            ->actions([
                Action::make('view')
                    ->button()
                    ->url(PermohonanSuratResource::getUrl('edit', ['record' => $permohonan],panel: 'admin')),
                  Action::make('markAsRead')
                      ->button()
                      ->markAsRead(),])
            ->sendToDatabase($admin); }
        return redirect()
            ->back()
            ->with('success', 'Permohonan surat berhasil diajukan! silahkan tunggu proses selesai, anda dapat mengeceknya melalui halaman status permohonan.');
    }



}
