<?php

class Home extends Controller {
    
    public function index() {
        // Memanggil ketiga file secara berurutan untuk merakit halaman web
        $this->view('templates/header');
        $this->view('home/index');
        $this->view('templates/footer');
    }
}