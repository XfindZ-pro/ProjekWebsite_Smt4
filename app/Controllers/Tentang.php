<?php

class Tentang extends Controller {
    
    public function index() {
        // 1. Set penanda halaman aktif ke 'tentang' agar navbar menyesuaikan
        $data['aktif'] = 'tentang';
        
        // 2. Panggil template dan view
        $this->view('templates/header', $data);
        $this->view('tentang/index'); 
        $this->view('templates/footer');
    }
}