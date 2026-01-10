<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
     public function index()
    {
        $beritas = Berita::with('admin')->latest()->paginate(6);
        return view('berita.index', compact('beritas'));
    }

    public function show($id)
    {
        $berita = Berita::with('admin')->findOrFail($id);
        return view('berita.show', compact('berita'));
    }
}
