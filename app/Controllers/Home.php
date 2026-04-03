<?php

class Home extends Controller {
    
    public function index() {
        // 1. Buat data penanda halaman aktif
        $data['aktif'] = 'beranda';
        
        // 2. Kirim $data ke header
        $this->view('templates/header', $data);
        $this->view('home/index');
        $this->view('templates/footer');
    }
}   