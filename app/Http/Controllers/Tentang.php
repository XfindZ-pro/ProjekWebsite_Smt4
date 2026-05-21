<?php

namespace App\Http\Controllers;

class Tentang extends Controller
{
    public function index()
    {
        $data['aktif'] = 'tentang';

        return view('templates.header', $data) .
               view('tentang.index') .
               view('templates.footer');
    }
}
