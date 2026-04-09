<?php

class Caribahanbaku extends Controller {
    public function index() {
        if (!isset($_SESSION['user_akun_id']) || empty($_SESSION['user_akun_id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $data['aktif'] = 'caribahanbaku';

        $this->view('templates/header', $data);
        $this->view('caribahanbaku/index', $data);
        $this->view('templates/footer');
    }
}
