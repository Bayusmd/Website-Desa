<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AduanMasyarakat;

class AduanTrackingController extends Controller
{
    /**
     * Menampilkan halaman tracking
     */
    public function index()
    {
        return view('aduan.riwayat');
    }

    /**
     * Proses pencarian aduan berdasarkan ID
     */
    public function search(Request $request)
    {
        $request->validate([
            'id_aduan' => 'required|digits_between:1,20'
        ], [
            'id_aduan.required' => 'ID Aduan harus diisi.',
            'id_aduan.digits_between' => 'ID Aduan hanya boleh angka dan maksimal 20 digit.'
        ]);

        $aduan = AduanMasyarakat::where('id_aduan', $request->id_aduan)->first();

        if (!$aduan) {
            return back()->withErrors([
                'id_aduan' => 'Aduan dengan ID tersebut tidak ditemukan.'
            ]);
        }

        return view('aduan.riwayat', [
            'aduan' => $aduan,
            'id_aduan' => $request->id_aduan
        ]);
    }
}
