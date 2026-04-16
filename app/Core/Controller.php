<?php

class Controller {
    public function view($view, $data = []) {
        if (isset($_SESSION['user_akun_id']) && !isset($_SESSION['user_peran'])) {
            $akunModel = $this->model('AkunModel');
            $user = $akunModel->getAkunById($_SESSION['user_akun_id']);
            if ($user && isset($user['peran'])) {
                $_SESSION['user_peran'] = trim(strtolower($user['peran']));
            }
        }

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