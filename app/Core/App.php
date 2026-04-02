<?php

class App {
    // Properti default jika URL kosong
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();
        
        // 1. Setup Controller
        // Cek apakah file controller-nya ada
        if(isset($url[0]) && file_exists('../app/Controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        
        // Panggil dan instansiasi controller-nya
        require_once '../app/Controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // 2. Setup Method
        if(isset($url[1])) {
            // Cek apakah method ada di dalam controller tersebut
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. Setup Params
        if(!empty($url)) {
            $this->params = array_values($url); // Mengambil sisa array sebagai parameter
        }

        // 4. Jalankan controller & method, serta kirim parameter jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Fungsi untuk mengambil dan membersihkan URL
    public function parseURL() {
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); // Hapus garis miring di akhir
            $url = filter_var($url, FILTER_SANITIZE_URL); // Bersihkan dari karakter aneh
            $url = explode('/', $url); // Pecah URL berdasarkan garis miring '/'
            return $url;
        }
        return [];
    }
}