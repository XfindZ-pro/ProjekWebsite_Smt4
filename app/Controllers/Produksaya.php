<?php

class Produksaya extends Controller {
    public function index() {
        if (!isset($_SESSION['user_akun_id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }
        $data['katalog'] = $this->model('AkunModel')->getProdukByPenjual($_SESSION['user_akun_id']);
        $this->view('templates/header', ['aktif' => 'produksaya']);
        $this->view('produksaya/index', $data);
        $this->view('templates/footer');
    }

    public function edit($id) {
        $produk = $this->model('AkunModel')->getProdukById($id);
        // Keamanan: Pastikan hanya pemilik yang bisa mengedit
        if (!$produk || $produk['penjual_id'] !== $_SESSION['user_akun_id']) {
            header('Location: ' . BASEURL . '/produksaya');
            exit;
        }
        $data['produk'] = $produk;
        $this->view('templates/header', ['judul' => 'Edit Produk']);
        $this->view('produksaya/edit', $data);
        $this->view('templates/footer');
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $getBlob = function($fileKey) {
                if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == 0) {
                    return file_get_contents($_FILES[$fileKey]['tmp_name']);
                }
                return null;
            };

            $data = [
                'produk_id' => $_POST['produk_id'],
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

            if ($this->model('AkunModel')->updateProduk($data)) {
                header('Location: ' . BASEURL . '/produksaya');
                exit;
            }
        }
    }

    public function hapus($id) {
        if ($this->model('AkunModel')->hapusProduk($id, $_SESSION['user_akun_id'])) {
            header('Location: ' . BASEURL . '/produksaya');
            exit;
        }
    }
}