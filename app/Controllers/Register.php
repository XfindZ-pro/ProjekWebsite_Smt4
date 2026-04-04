<?php

class Register extends Controller {
    public function index() {
        $data['aktif'] = 'register';
        $this->view('templates/header', $data);
        $this->view('auth/register');
        $this->view('templates/footer');
    }

    public function proses() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // 1. Cek Kesamaan Password
            if ($password !== $confirm_password) {
                echo "<script>alert('Konfirmasi password tidak cocok!'); window.location.href='".BASEURL."/register';</script>";
                return;
            }

            $akunModel = $this->model('AkunModel');

            // 2. Cek Duplikat Email
            if ($akunModel->cekEmail($email)) {
                echo "<script>alert('Email sudah terdaftar! Silakan gunakan email lain.'); window.location.href='".BASEURL."/register';</script>";
                return;
            }

            // 3. Simpan ke Database
            if ($akunModel->tambahAkun($_POST)) {
                // Set Session Login
                $_SESSION['user_nama'] = $nama;
                $_SESSION['user_foto'] = null;
                
                echo "<script>alert('Pendaftaran Berhasil! Selamat datang di Valora.'); window.location.href='".BASEURL."';</script>";
            } else {
                echo "<script>alert('Sistem Error! Gagal mendaftar.'); window.location.href='".BASEURL."/register';</script>";
            }
        }
    }
}