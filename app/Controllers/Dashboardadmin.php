<?php

class Dashboardadmin extends Controller {
    public function index() {
        // Proteksi halaman khusus admin
        if (!isset($_SESSION['user_akun_id']) || !isset($_SESSION['user_peran']) || $_SESSION['user_peran'] !== 'admin') {
            header('Location: ' . BASEURL);
            exit;
        }

        $akunModel = $this->model('AkunModel');
        $data['aktif'] = 'dashboardadmin';
        
        // Menarik data tabel pengajuan verifikasi
        $data['verifikasi_list'] = $akunModel->getPendingVerifications();
        $data['recent_submissions'] = $akunModel->getRecentVerifications(3);
        
        // Memuat statistik dinamis untuk 4 kotak dashboard
        $data['total_users'] = $akunModel->countUsers();
        $data['pending_verifications'] = $akunModel->countPendingVerifications();
        $data['product_active'] = $akunModel->countActiveProducts();
        $data['approved_today'] = $akunModel->countApprovedToday();

        $this->view('templates/header', $data);
        $this->view('dashboardadmin/index', $data);
        $this->view('templates/footer');
    }

    public function setujui($v_id, $akun_id) {
        if ($this->model('AkunModel')->approveVerification($v_id, $akun_id)) {
            header('Location: ' . BASEURL . '/dashboardadmin');
            exit;
        }
    }

    public function tolak($v_id, $akun_id) {
        if ($this->model('AkunModel')->rejectVerification($v_id, $akun_id)) {
            header('Location: ' . BASEURL . '/dashboardadmin');
            exit;
        }
    }
}