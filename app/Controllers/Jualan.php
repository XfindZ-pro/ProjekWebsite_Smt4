<?php

class Jualan extends Controller {
    public function index() {
        // Cek apakah pengguna sudah login
        if (!isset($_SESSION['user_akun_id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        // Cek Status Verifikasi Pengguna
        $user = $this->model('AkunModel')->getAkunById($_SESSION['user_akun_id']);
        if ($user['status_verifikasi'] !== 'disetujui') {
            header('Location: ' . BASEURL . '/verifikasiakun');
            exit;
        }

        $data['judul'] = 'Jual Sisa Produksi';
        $data['aktif'] = 'jualan';
        
        $this->view('templates/header', $data);
        $this->view('jualan/index', $data);
        $this->view('templates/footer');
    }

    public function proses() {
        // FIX ERROR: Proteksi tambahan. Pastikan sesi login masih aktif sebelum memproses form.
        // Jika sesi habis, kembalikan ke halaman login.
        if (!isset($_SESSION['user_akun_id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $getBlob = function($fileKey) {
                if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == 0) {
                    return file_get_contents($_FILES[$fileKey]['tmp_name']);
                }
                return null;
            };

            // Menambahkan fallback (??) agar aman dari undefined array key
            $dataProduk = [
                'penjual_id' => $_SESSION['user_akun_id'], // Sekarang ini dipastikan aman karena sudah dicek di atas
                'nama_produk' => $_POST['nama_produk'] ?? '',
                'kategori_limbah' => $_POST['kategori_limbah'] ?? '',
                'berat_tersedia' => $_POST['berat_tersedia'] ?? 0,
                'harga_per_kg' => $_POST['harga_per_kg'] ?? 0,
                'min_order' => $_POST['min_order'] ?? 1,
                'lokasi_pickup' => $_POST['lokasi_pickup'] ?? '',
                'kondisi_harga' => $_POST['kondisi_harga'] ?? 'Harga Pas',
                'deskripsi' => $_POST['deskripsi'] ?? '',
                'kondisi_fisik' => $_POST['kondisi_fisik'] ?? 'Sisa Produksi',
                'metode_pengemasan' => $_POST['metode_pengemasan'] ?? 'Tanpa Kemasan',
                'foto_1' => $getBlob('foto_1'),
                'foto_2' => $getBlob('foto_2'),
                'foto_3' => $getBlob('foto_3'),
                'dokumen_pendukung' => $getBlob('dokumen_pendukung'),
                'status_produk' => isset($_POST['draft']) ? 'draft' : 'aktif'
            ];

            if ($this->model('AkunModel')->tambahProduk($dataProduk)) {
                header('Location: ' . BASEURL . '/caribahanbaku'); 
                exit;
            } else {
                echo "<script>alert('Gagal mengunggah produk. Pastikan format gambar sesuai.'); window.history.back();</script>";
            }
        }
    }
}