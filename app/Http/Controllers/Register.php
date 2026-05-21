<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Register extends Controller
{
    public function index()
    {
        $data['aktif'] = 'register';
        return view('templates.header', $data) .
               view('auth.register') .
               view('templates.footer');
    }

    public function proses(Request $request)
    {
        if ($request->getMethod() === 'POST') {
            $nama = $request->input('nama');
            $email = $request->input('email');
            $password = $request->input('password');
            $confirm_password = $request->input('confirm_password');

            if ($password !== $confirm_password) {
                return redirect('/register')->with('error', 'Konfirmasi password tidak cocok!');
            }

            $akunModel = $this->model('AkunModel');

            if ($akunModel->cekEmail($email)) {
                return redirect('/register')->with('error', 'Email sudah terdaftar! Silakan gunakan email lain.');
            }

            if ($akunModel->tambahAkun($request->all())) {
                $_SESSION['user_nama'] = $nama;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_peran'] = 'pengguna';
                $_SESSION['user_foto'] = null;
                
                $createdUser = $akunModel->getAkunByEmail($email);
                if ($createdUser) {
                    $_SESSION['user_akun_id'] = $createdUser['akun_id'];
                }

                return redirect('/')->with('success', 'Pendaftaran Berhasil! Selamat datang di Valora.');
            } else {
                return redirect('/register')->with('error', 'Sistem Error! Gagal mendaftar.');
            }
        }
    }
}
