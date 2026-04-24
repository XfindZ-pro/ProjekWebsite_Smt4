<?php

class Home extends Controller {
    
    public function index() {
        $data['aktif'] = 'beranda';
        $data['has_products'] = false; // Nilai default
        
        // Jika pengguna sudah login, cek apakah dia punya produk
        if (isset($_SESSION['user_akun_id'])) {
            $produkModel = $this->model('ProdukModel');
            $data['has_products'] = $produkModel->hasProducts($_SESSION['user_akun_id']);
        }
        
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}