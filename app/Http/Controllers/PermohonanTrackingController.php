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
            'nik' => 'required|numeric'
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
