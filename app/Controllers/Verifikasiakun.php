<?php

class Verifikasiakun extends Controller {
    public function index() {
        if (!isset($_SESSION['user_akun_id']) || empty($_SESSION['user_akun_id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $akunModel = $this->model('AkunModel');
        $user = $akunModel->getAkunById($_SESSION['user_akun_id']);

        if ($user && $user['status_verifikasi'] === 'disetujui') {
            header('Location: ' . BASEURL . '/jualan');
            exit;
        }

        $data['aktif'] = 'verifikasiakun';
        $data['user'] = $user;
        $data['pending'] = isset($user['status_verifikasi']) && $user['status_verifikasi'] === 'menunggu';
        $data['message'] = $_GET['message'] ?? null;
        $data['message_type'] = $_GET['type'] ?? null;

        $this->view('templates/header', $data);
        $this->view('verifikasiakun/index', $data);
        $this->view('templates/footer');
    }

    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL . '/verifikasiakun');
            exit;
        }

        if (!isset($_SESSION['user_akun_id']) || empty($_SESSION['user_akun_id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $akunModel = $this->model('AkunModel');
        $user = $akunModel->getAkunById($_SESSION['user_akun_id']);

        if ($user && $user['status_verifikasi'] === 'disetujui') {
            header('Location: ' . BASEURL . '/jualan');
            exit;
        }

        if ($user && $user['status_verifikasi'] === 'menunggu') {
            header('Location: ' . BASEURL . '/verifikasiakun?message=' . rawurlencode('Pengajuan Anda sedang diproses.') . '&type=info');
            exit;
        }

        $jenis_entitas = $_POST['jenis_entitas'] ?? '';
        $nama_usaha = trim($_POST['nama_usaha'] ?? '');
        $alamat_usaha = trim($_POST['alamat_usaha'] ?? '');
        $nomor_telepon = trim($_POST['nomor_telepon'] ?? '');

        if (empty($jenis_entitas) || empty($nama_usaha) || empty($alamat_usaha) || empty($nomor_telepon)) {
            header('Location: ' . BASEURL . '/verifikasiakun?message=' . rawurlencode('Semua kolom wajib diisi.') . '&type=error');
            exit;
        }

        if (!isset($_FILES['file_ktp']) || $_FILES['file_ktp']['error'] !== UPLOAD_ERR_OK || !isset($_FILES['file_izin_usaha']) || $_FILES['file_izin_usaha']['error'] !== UPLOAD_ERR_OK) {
            header('Location: ' . BASEURL . '/verifikasiakun?message=' . rawurlencode('File KTP dan/atau izin usaha wajib diunggah.') . '&type=error');
            exit;
        }

        $allowedTypes = [
            'image/jpeg',
            'image/png',
            'application/pdf'
        ];

        $ktpMime = mime_content_type($_FILES['file_ktp']['tmp_name']);
        $izinMime = mime_content_type($_FILES['file_izin_usaha']['tmp_name']);

        if (!in_array($ktpMime, $allowedTypes, true) || !in_array($izinMime, $allowedTypes, true)) {
            header('Location: ' . BASEURL . '/verifikasiakun?message=' . rawurlencode('Format file tidak didukung. Gunakan JPG, PNG, atau PDF.') . '&type=error');
            exit;
        }

        $file_ktp = file_get_contents($_FILES['file_ktp']['tmp_name']);
        $file_izin_usaha = file_get_contents($_FILES['file_izin_usaha']['tmp_name']);

        if ($file_ktp === false || $file_izin_usaha === false) {
            header('Location: ' . BASEURL . '/verifikasiakun?message=' . rawurlencode('Gagal memproses file yang diunggah.') . '&type=error');
            exit;
        }

        $payload = [
            'akun_id' => $_SESSION['user_akun_id'],
            'jenis_entitas' => $jenis_entitas,
            'nama_usaha' => $nama_usaha,
            'file_ktp' => $file_ktp,
            'file_izin_usaha' => $file_izin_usaha,
            'alamat_usaha' => $alamat_usaha,
            'nomor_telepon' => $nomor_telepon,
        ];

        $success = $akunModel->ajukanVerifikasi($payload);
        if ($success) {
            $akunModel->updateStatusVerifikasi($_SESSION['user_akun_id'], 'menunggu');
            header('Location: ' . BASEURL . '/verifikasiakun?message=' . rawurlencode('Pengajuan berhasil. Status akun sekarang menunggu verifikasi.') . '&type=success');
            exit;
        }

        header('Location: ' . BASEURL . '/verifikasiakun?message=' . rawurlencode('Gagal mengajukan verifikasi. Silakan coba lagi.') . '&type=error');
        exit;
    }
}
