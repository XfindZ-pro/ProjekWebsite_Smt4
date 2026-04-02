<?php

class Controller {
    // Fungsi untuk memanggil file View
    public function view($view, $data = []) {
        require_once '../app/views/' . $view . '.php';
    }

    // Fungsi untuk memanggil file Model (untuk database)
    public function model($model) {
        require_once '../app/Models/' . $model . '.php';
        return new $model;
    }
}