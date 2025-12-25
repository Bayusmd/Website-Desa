<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PermohonanSurat;

class PermohonanTrackingController extends Controller
{
    public function index()
    {
        return view('permohonan.riwayat');
    }

    public function search()
    {
        request()->validate([
            'nik' => 'required|numeric|digits:16'
        ],
    [
        'nik.digits' => 'NIK harus berjumlah 16 digit.',
         'nik.required' => 'NIK harus di isi dan  berjumlah 16 digit.'
    ]);

        $permohonan = PermohonanSurat::with('layanan', 'berkas')
            ->where('nik_pemohon', request('nik'))
            ->orderBy('tanggal_permohonan', 'DESC')
            ->get();

        return view('permohonan.riwayat', [
            'data' => $permohonan,
            'nik' => request('nik')
        ]);
    }
}
