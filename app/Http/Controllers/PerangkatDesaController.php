<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDesa;

class PerangkatDesaController extends Controller
{
    public function index()
    {
        return view('perangkat.index', [
            'perangkat' => PerangkatDesa::orderBy('id', 'asc')
            ->get()

        ]);
    }
}
