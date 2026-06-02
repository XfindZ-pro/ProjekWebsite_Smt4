<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Detail extends Controller
{
    public function index($id)
    {
        try {
            $produkModel = $this->model('ProdukModel');
            $akunModel = $this->model('AkunModel');
            
            // Get product details
            $produk = $produkModel->getProdukById($id);
            
            if (!$produk) {
                return redirect('/caribahanbaku')->with('error', 'Produk tidak ditemukan.');
            }
            
            // Get seller info
            $penjual = $akunModel->getAkunById($produk['penjual_id']);
            
            $data['aktif'] = 'caribahanbaku';
            $data['produk'] = $produk;
            $data['penjual'] = $penjual;
            
            return view('templates.header', $data) .
                   view('detail.index', $data) .
                   view('templates.footer');
        } catch (Exception $e) {
            return redirect('/caribahanbaku')->with('error', 'Terjadi kesalahan saat memuat produk.');
        }
    }
}
