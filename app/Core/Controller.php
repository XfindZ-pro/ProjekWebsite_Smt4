<?php

class Controller {
    // Fungsi untuk memanggil file View
    public function view($view, $data = []) {
        require_once '../views/' . $view . '.php'; // Benar
    }

    // Fungsi untuk memanggil file Model (untuk database)
    public function model($model) {
        require_once '../app/Models/' . $model . '.php';
        return new $model;
    }
}