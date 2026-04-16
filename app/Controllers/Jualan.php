<?php

class Jualan extends Controller {
    public function index() {
        // Cek login
        if (!isset($_SESSION['user_akun_id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        // Cek Verifikasi: Hanya yang 'disetujui' yang bisa akses
        $user = $this->model('AkunModel')->getAkunById($_SESSION['user_akun_id']);
        if ($user['status_verifikasi'] !== 'disetujui') {
            // Jika belum disetujui, arahkan ke halaman profil/status
            header('Location: ' . BASEURL . '/profile');
            exit;
        }

        $data['judul'] = 'Jual Sisa Produksi';
        $data['aktif'] = 'jualan';
        
        $this->view('templates/header', $data);
        $this->view('jualan/index', $data);
        $this->view('templates/footer');
    }

    public function proses() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Fungsi pembantu untuk memproses file ke Blob
            $getBlob = function($fileKey) {
                if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == 0) {
                    return file_get_contents($_FILES[$fileKey]['tmp_name']);
                }
                return null;
            };

            $dataProduk = [
                'penjual_id' => $_SESSION['user_akun_id'],
                'nama_produk' => $_POST['nama_produk'],
                'kategori_limbah' => $_POST['kategori_limbah'],
                'berat_tersedia' => $_POST['berat_tersedia'],
                'harga_per_kg' => $_POST['harga_per_kg'],
                'min_order' => $_POST['min_order'],
                'lokasi_pickup' => $_POST['lokasi_pickup'],
                'kondisi_harga' => $_POST['kondisi_harga'],
                'deskripsi' => $_POST['deskripsi'],
                'kondisi_fisik' => $_POST['kondisi_fisik'],
                'metode_pengemasan' => $_POST['metode_pengemasan'],
                'foto_1' => $getBlob('foto_1'),
                'foto_2' => $getBlob('foto_2'),
                'foto_3' => $getBlob('foto_3'),
                'dokumen_pendukung' => $getBlob('dokumen_pendukung'),
                'status_produk' => isset($_POST['draft']) ? 'draft' : 'aktif'
            ];

            if ($this->model('AkunModel')->tambahProduk($dataProduk)) {
                header('Location: ' . BASEURL . '/katalog');
                exit;
            } else {
                echo "Gagal mengunggah produk.";
            }
        }
    }
}