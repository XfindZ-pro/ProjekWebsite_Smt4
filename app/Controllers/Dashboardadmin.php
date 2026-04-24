<?php

class Dashboardadmin extends Controller {
    public function index() {
        // Proteksi halaman khusus admin
        if (!isset($_SESSION['user_akun_id']) || !isset($_SESSION['user_peran']) || $_SESSION['user_peran'] !== 'admin') {
            header('Location: ' . BASEURL);
            exit;
        }

        $akunModel = $this->model('AkunModel');
        $verifikasiModel = $this->model('VerifikasiModel');
        $produkModel = $this->model('ProdukModel');
        $data['aktif'] = 'dashboardadmin';
        
        // Menarik data antrean verifikasi
        $data['verifikasi_list'] = $verifikasiModel->getPendingVerifications();
        $data['recent_submissions'] = $verifikasiModel->getRecentVerifications(3);
        
        // Menarik data SEMUA pengguna dan konversi format Foto
        $users = $akunModel->getAllUsers();
        foreach ($users as &$u) {
            // Proses Foto Profil
            if (!empty($u['foto_profil'])) {
                $u['foto_profil'] = 'data:image/jpeg;base64,' . base64_encode($u['foto_profil']);
            } else {
                // Fallback avatar UI jika tidak ada foto
                $u['foto_profil'] = "https://ui-avatars.com/api/?name=" . urlencode($u['nama']) . "&background=10b981&color=fff&size=512";
            }
            
            // Proses Foto Banner
            if (!empty($u['foto_banner'])) {
                $u['foto_banner'] = 'data:image/jpeg;base64,' . base64_encode($u['foto_banner']);
            } else {
                // Fallback foto pemandangan jika tidak ada banner
                $u['foto_banner'] = 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1400&q=80';
            }
        }
        $data['users_list'] = $users;
        
        // Memuat statistik dinamis
        $data['total_users'] = $akunModel->countUsers();
        $data['pending_verifications'] = $verifikasiModel->countPendingVerifications();
        $data['product_active'] = $produkModel->countActiveProducts();
        $data['approved_today'] = $verifikasiModel->countApprovedToday();

        $this->view('templates/header', $data);
        $this->view('dashboardadmin/index', $data);
        $this->view('templates/footer');
    }

    public function setujui($v_id, $akun_id) {
        if ($this->model('VerifikasiModel')->approveVerification($v_id, $akun_id)) {
            header('Location: ' . BASEURL . '/dashboardadmin');
            exit;
        }
    }

    public function tolak($v_id, $akun_id) {
        if ($this->model('VerifikasiModel')->rejectVerification($v_id, $akun_id)) {
            header('Location: ' . BASEURL . '/dashboardadmin');
            exit;
        }
    }
}