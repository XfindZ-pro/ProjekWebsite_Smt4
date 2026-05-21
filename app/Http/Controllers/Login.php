<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Login extends Controller
{
    public function index(Request $request)
    {
        if (isset($_SESSION['user_nama'])) {
            return redirect('/');
        }

        if ($request->getMethod() === 'POST') {
            $email = $request->input('email');
            $password = $request->input('password');

            $akunModel = $this->model('AkunModel');
            $user = $akunModel->getAkunByEmail($email);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_nama'] = $user['nama'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_akun_id'] = $user['akun_id'];
                    $_SESSION['user_peran'] = trim(strtolower($user['peran'] ?? 'pengguna'));

                    $avatarValue = $user['foto_profil'];
                    if (!empty($avatarValue) && !preg_match('/^(https?:\/\/|\/|data:image\/)/', $avatarValue)) {
                        $imageInfo = @getimagesizefromstring($avatarValue);
                        if ($imageInfo) {
                            $avatarValue = 'data:' . $imageInfo['mime'] . ';base64,' . base64_encode($avatarValue);
                        }
                    }
                    $_SESSION['user_foto'] = $avatarValue;
                    
                    return redirect('/');
                } else {
                    return redirect('/login')->with('error', 'Password yang kamu masukkan salah!');
                }
            } else {
                return redirect('/login')->with('error', 'Email tidak terdaftar di sistem Valora!');
            }
        }

        $data['aktif'] = 'login';
        return view('templates.header', $data) .
               view('auth.login') .
               view('templates.footer');
    }
}
