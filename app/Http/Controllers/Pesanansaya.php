<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pesanansaya extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return redirect('/login');
        }

        try {
            $orderModel = $this->model('OrderModel');
            $orders = $orderModel->getOrdersByPembeli($_SESSION['user_akun_id']);

            $data['aktif'] = 'pesanansaya';
            $data['judul'] = 'Pesanan Saya';
            $data['orders'] = $orders;

            return view('templates.header', $data) .
                   view('pesanansaya.index', $data) .
                   view('templates.footer');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Terjadi kesalahan saat memuat halaman Pesanan Saya.');
        }
    }
}
