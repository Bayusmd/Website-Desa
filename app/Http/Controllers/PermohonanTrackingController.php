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
            'id_permohonan' => 'required|digits_between:1,20'
        ], [
            'id_permohonan.required' => 'ID harus diisi.',
            'id_permohonan.digits_between' => 'ID harus berupa angka dan maksimal 20 digit.'
        ]);


        $permohonan = PermohonanSurat::with('layanan', 'berkas')
            ->where('id_permohonan', request('id_permohonan'))
            ->orderBy('tanggal_permohonan', 'DESC')
            ->get();

        return view('permohonan.riwayat', [
            'data' => $permohonan,
            'id_permohonan' => request('id_permohonan')
        ]);
    }
}
