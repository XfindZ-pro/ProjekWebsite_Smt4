<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    public function index()
    {
        $data['aktif'] = 'beranda';
        $data['has_products'] = false;
        
        if (isset($_SESSION['user_akun_id'])) {
            $produkModel = $this->model('ProdukModel');
            $data['has_products'] = $produkModel->hasProducts($_SESSION['user_akun_id']);
        }
        
        return view('templates.header', $data) . 
               view('home.index', $data) . 
               view('templates.footer');
    }
}
