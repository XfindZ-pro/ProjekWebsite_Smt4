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
        
        // Jika belum disetujui (termasuk status 'tanpa_verifikasi'), arahkan langsung ke halaman verifikasi akun
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Fungsi pembantu untuk memproses file ke format Data Biner (Blob)
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
                
                // Menentukan status berdasarkan tombol submit yang ditekan (Draft atau Tayangkan)
                'status_produk' => isset($_POST['draft']) ? 'draft' : 'aktif'
            ];

            // Masukkan data ke dalam database melalui model
            if ($this->model('AkunModel')->tambahProduk($dataProduk)) {
                // Jika berhasil, arahkan kembali ke katalog
                header('Location: ' . BASEURL . '/katalog');
                exit;
            } else {
                echo "Gagal mengunggah produk. Pastikan semua file sesuai format.";
            }
        }
    }
}