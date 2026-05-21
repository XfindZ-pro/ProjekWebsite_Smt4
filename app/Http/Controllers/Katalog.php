<?php

namespace App\Http\Controllers;

class Katalog extends Controller
{
    public function index()
    {
        $data['aktif'] = 'katalog';

        return view('templates.header', $data) .
               view('katalog.index') .
               view('templates.footer');
    }
}
