<?php

class Controller {
    // Fungsi untuk memanggil file View
    public function view($view, $data = []) {
        
        // Cek koneksi database setiap kali view dipanggil
        $db = new Database();
        $data['db_status'] = $db->isConnected;

        require_once __DIR__ . '../views/' . $view . '.php';
    }

    // Fungsi untuk memanggil file Model
    public function model($model) {
        require_once __DIR__ . '../app/Models/' . $model . '.php';
        return new $model;
    }
}