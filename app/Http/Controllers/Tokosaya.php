<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Tokosaya extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return redirect('/login');
        }

        $akunModel = $this->model('AkunModel');
        $user = $akunModel->getAkunById($_SESSION['user_akun_id']);

        if (!$user || ($user['status_verifikasi'] ?? '') !== 'disetujui') {
            return redirect('/verifikasiakun')->with([
                'message' => 'Anda harus terverifikasi sebagai mitra untuk mengakses halaman Toko Saya.',
                'type' => 'warning'
            ]);
        }

        $produkModel = $this->model('ProdukModel');
        $orderModel = $this->model('OrderModel');

        // Fetch products and orders
        $produkList = $produkModel->getProdukByPenjual($_SESSION['user_akun_id']);
        $orders = $orderModel->getOrdersByPenjual($_SESSION['user_akun_id']);

        // 1. Calculate General Statistics
        $totalProduk = count($produkList);
        $totalStok = 0;
        foreach ($produkList as $p) {
            $totalStok += floatval($p['berat_tersedia']);
        }

        $totalTerjual = 0;
        $totalPendapatan = 0;
        foreach ($orders as $o) {
            if (($o['status_order'] ?? '') === 'selesai') {
                $totalTerjual += floatval($o['jumlah']);
                $totalPendapatan += floatval($o['subtotal']);
            }
        }

        // 2. Prepare Category Stats (Stock available per category)
        $categoryStats = [
            'Tekstil' => 0,
            'Plastik' => 0,
            'Kertas' => 0,
            'Logam' => 0,
            'Kaca' => 0,
            'Kayu' => 0,
            'Lainnya' => 0
        ];
        foreach ($produkList as $p) {
            $cat = $p['kategori_limbah'] ?? 'Lainnya';
            if (array_key_exists($cat, $categoryStats)) {
                $categoryStats[$cat] += floatval($p['berat_tersedia']);
            } else {
                $categoryStats['Lainnya'] += floatval($p['berat_tersedia']);
            }
        }

        // 3. Prepare Sales Stats per Product (Quantity sold in kg)
        $productSalesStats = [];
        foreach ($orders as $o) {
            if (($o['status_order'] ?? '') === 'selesai') {
                $prodName = $o['nama_produk'] ?? 'Produk';
                if (!isset($productSalesStats[$prodName])) {
                    $productSalesStats[$prodName] = 0;
                }
                $productSalesStats[$prodName] += floatval($o['jumlah']);
            }
        }

        // 4. Build return data
        $data['judul'] = 'Toko Saya - Valora';
        $data['aktif'] = 'tokosaya';
        $data['user'] = $user;
        
        $data['stats'] = [
            'total_produk' => $totalProduk,
            'total_stok' => $totalStok,
            'total_terjual' => $totalTerjual,
            'total_pendapatan' => $totalPendapatan
        ];
        
        $data['category_labels'] = array_keys($categoryStats);
        $data['category_data'] = array_values($categoryStats);

        $data['product_labels'] = array_keys($productSalesStats);
        $data['product_data'] = array_values($productSalesStats);
        
        $data['produk_list'] = array_slice($produkList, 0, 5); // Show latest 5 products in list

        return view('templates.header', $data) .
               view('tokosaya.index', $data) .
               view('templates.footer');
    }
}
