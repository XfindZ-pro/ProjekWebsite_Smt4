<?php

class Produksaya extends Controller {
    public function index() {
        // Proteksi: Hanya pengguna yang sudah login yang bisa melihat produknya
        if (!isset($_SESSION['user_akun_id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $akunModel = $this->model('AkunModel');
        
        $data['judul'] = 'Produk Saya';
        $data['aktif'] = 'produksaya'; 
        
        // Menarik semua produk (baik yang Aktif maupun Draft) yang dijual oleh akun ini
        $data['katalog'] = $akunModel->getProdukByPenjual($_SESSION['user_akun_id']);

        $this->view('templates/header', $data);
        $this->view('produksaya/index', $data);
        $this->view('templates/footer');
    }
}