<?php

class Login extends Controller {
    public function index() {
        // Jika sudah login, langsung lempar kembali ke Beranda
        if (isset($_SESSION['user_nama'])) {
            header('Location: ' . BASEURL);
            exit;
        }

        // Jika tombol Submit ditekan (Metode POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $akunModel = $this->model('AkunModel');
            $user = $akunModel->getAkunByEmail($email);

            // Cek apakah akun dengan email tersebut ditemukan
            if ($user) {
                // Jika email ada, cek kecocokan password
                if (password_verify($password, $user['password'])) {
                    
                    // Jika benar, set Session Login
                    $_SESSION['user_nama'] = $user['nama'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_akun_id'] = $user['akun_id'];
                    $_SESSION['user_foto'] = $user['foto_profil']; 
                    
                    // Langsung arahkan ke beranda tanpa pop-up alert
                    header('Location: ' . BASEURL);
                    exit;
                } else {
                    // Pop up gagal karena password salah
                    echo "<script>
                            alert('Login Gagal: Password yang kamu masukkan salah!'); 
                            window.location.href='".BASEURL."/login';
                          </script>";
                    exit;
                }
            } else {
                // Pop up gagal karena email tidak terdaftar
                echo "<script>
                        alert('Login Gagal: Email tidak terdaftar di sistem Valora!'); 
                        window.location.href='".BASEURL."/login';
                      </script>";
                exit;
            }
        }

        // Jika sekadar membuka halaman (Metode GET)
        $data['aktif'] = 'login';
        
        $this->view('templates/header', $data);
        $this->view('auth/login');
        $this->view('templates/footer');
    }
}