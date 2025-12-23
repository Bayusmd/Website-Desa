<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AgendaDesa;

class AgendaController extends Controller
{
    public function index()
    {
        return view('agenda.index', [
            'agenda' => AgendaDesa::latest()->paginate(10)
        ]);
    }

    public function show($id)
    {
        return view('agenda.show', [
            'agenda' => AgendaDesa::findOrFail($id)
        ]);
    }
}
