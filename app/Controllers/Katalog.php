<?php

class Katalog extends Controller {
    
    public function index() {
        // 1. Set penanda halaman aktif ke 'katalog' agar navbar menyesuaikan
        $data['aktif'] = 'katalog';
        
        // 2. Panggil template dan view
        $this->view('templates/header', $data);
        $this->view('katalog/index'); // Kita akan buat file ini di langkah 2
        $this->view('templates/footer');
    }
}