<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InformasiDesa;

class InformasiController extends Controller
{
    public function index()
    {
        return view('informasi.index', [
            'informasi' => InformasiDesa::latest()->paginate(10)
        ]);
    }

    public function show($id)
    {
        $info = InformasiDesa::findOrFail($id);

    return view('informasi.show', compact('info'));
    }
}
