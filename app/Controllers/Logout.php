<?php

class Logout extends Controller {
    public function index() {
        // 1. Kosongkan semua variabel session (user_nama, user_foto, dll)
        session_unset();
        
        // 2. Hancurkan session secara keseluruhan
        session_destroy();

        // 3. Arahkan pengguna kembali ke halaman Beranda (Home)
        header('Location: ' . BASEURL);
        
        // 4. Pastikan script berhenti dieksekusi setelah diarahkan
        exit;
    }
}