<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Checkout extends Controller
{
    public function index($id)
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return redirect('/login');
        }

        try {
            $produkModel = $this->model('ProdukModel');
            
            // Get product details
            $produk = $produkModel->getProdukById($id);
            
            if (!$produk) {
                return redirect('/caribahanbaku')->with('error', 'Produk tidak ditemukan.');
            }
            
            // Prevent seller from buying their own product
            if ($_SESSION['user_akun_id'] == $produk['penjual_id']) {
                return redirect('/detail/' . $id)->with('error', 'Anda tidak dapat membeli produk Anda sendiri.');
            }

            $data['aktif'] = 'caribahanbaku';
            $data['produk'] = $produk;
            $data['judul'] = 'Checkout Produk';
            
            return view('templates.header', $data) .
                   view('checkout.index', $data) .
                   view('templates.footer');
        } catch (\Exception $e) {
            return redirect('/caribahanbaku')->with('error', 'Terjadi kesalahan saat memuat halaman checkout.');
        }
    }
}
