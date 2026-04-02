<?php

// Class Home ini "extends" (mewarisi) kemampuan dari base Controller kita
class Home extends Controller {
    
    // Method index adalah method default yang dijalankan jika URL kosong
    public function index() {
        // Memanggil file view yang ada di folder views/home/index.php
        $this->view('home/index');
    }
}