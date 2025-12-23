<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InformasiDesa;
use App\Models\AgendaDesa;
use App\Models\PerangkatDesa;
use App\Models\Galeri;
use App\Models\Berita;

class HomeController extends Controller
{
    public function index()
    {
        $kepalaDesa = PerangkatDesa::where('jabatan', 'Kepala Desa')->first();
        $perangkatPreview = PerangkatDesa::limit(4)->get();
        $galeri = Galeri::latest()->get();
        $beritas = Berita::latest()->take(3)->get();




    return view('home', compact('kepalaDesa', 'perangkatPreview', 'galeri', 'beritas'));
    }
}
