<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Order extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return redirect('/login');
        }

        $akunModel = $this->model('AkunModel');
        $user = $akunModel->getAkunById($_SESSION['user_akun_id']);
        
        if ($user['status_verifikasi'] !== 'disetujui') {
            return redirect('/verifikasiakun');
        }

        $data['judul'] = 'Order Masuk';
        $data['aktif'] = 'order';
        $data['orders'] = []; // Placeholder untuk pesanan masuk

        return view('templates.header', $data) .
               view('order.index', $data) .
               view('templates.footer');
    }
}
