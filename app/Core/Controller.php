<?php

class Controller {
    public function view($view, $data = []) {
        
        $db = new Database();
        $data['db_status'] = $db->isConnected;

        extract($data);

        require_once __DIR__ . '/../../views/' . $view . '.php';
    }

    public function model($model) {
        require_once __DIR__ . '/../../app/Models/' . $model . '.php';
        return new $model;
    }
}