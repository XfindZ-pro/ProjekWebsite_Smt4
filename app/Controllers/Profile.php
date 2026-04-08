<?php

class Profile extends Controller {
    public function index() {
        $akunModel = $this->model('AkunModel');
        $user = null;

        if (isset($_SESSION['user_akun_id'])) {
            $user = $akunModel->getAkunById($_SESSION['user_akun_id']);
        }

        if (!$user && isset($_SESSION['user_email'])) {
            $user = $akunModel->getAkunByEmail($_SESSION['user_email']);
        }

        if (!$user && isset($_SESSION['user_nama'])) {
            $user = $akunModel->getAkunByNama($_SESSION['user_nama']);
        }

        if (!$user) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $data['aktif'] = 'profile';
        $data['user'] = $user;

        $this->view('templates/header', $data);
        $this->view('profile/index', $data);
        $this->view('templates/footer');
    }
}
