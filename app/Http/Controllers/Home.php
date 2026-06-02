<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    public function index()
    {
        $data['aktif'] = 'beranda';
        $data['has_products'] = false;
        $data['is_verified'] = false;
        
        if (isset($_SESSION['user_akun_id'])) {
            $produkModel = $this->model('ProdukModel');
            $data['has_products'] = $produkModel->hasProducts($_SESSION['user_akun_id']);
            
            $akunModel = $this->model('AkunModel');
            $user = $akunModel->getAkunById($_SESSION['user_akun_id']);
            if ($user && $user['status_verifikasi'] === 'disetujui') {
                $data['is_verified'] = true;
            }
        }
        
        return view('templates.header', $data) . 
               view('home.index', $data) . 
               view('templates.footer');
    }
}
