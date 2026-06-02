<?php

namespace App\Http\Controllers;

class DaftarMitra extends Controller
{
    public function index()
    {
        $akunModel = $this->model('AkunModel');
        
        $data['aktif'] = 'katalog';
        $data['mitra'] = $akunModel->getVerifiedPartners();

        return view('templates.header', $data) .
               view('katalog.index', $data) .
               view('templates.footer');
    }
}
