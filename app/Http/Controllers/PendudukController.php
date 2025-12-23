<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PendudukController extends Controller
{

    public function index()
    {
        $response = Http::get(
            'https://satudata.karanganyarkab.go.id/api/demografi/jumlah_desa/3/2002'
        );

        return $response->json();
    }

}
