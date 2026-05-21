<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Lupapassword extends Controller
{
    public function index(Request $request)
    {
        $data['aktif'] = 'lupapassword';
        $data['message'] = $request->get('message');
        $data['message_type'] = $request->get('type');

        return view('templates.header', $data) .
               view('lupapassword.index', $data) .
               view('templates.footer');
    }

    public function sendReset(Request $request)
    {
        $email = trim($request->input('email', ''));
        
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect('/lupapassword')->with([
                'message' => 'Email tidak valid.',
                'type' => 'error'
            ]);
        }

        $akunModel = $this->model('AkunModel');
        $otpModel = $this->model('OtpModel');
        $user = $akunModel->getAkunByEmail($email);

        if (!$user) {
            return redirect('/lupapassword')->with([
                'message' => 'Email tidak terdaftar.',
                'type' => 'error'
            ]);
        }

        $otpModel->expireOtpsByEmail($email);
        $otpCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiry = date('Y-m-d H:i:s', strtotime('+3 minutes'));

        if (!$otpModel->createOtp($email, $otpCode, $expiry)) {
            return redirect('/lupapassword')->with([
                'message' => 'Gagal memproses permintaan. Coba lagi.',
                'type' => 'error'
            ]);
        }

        if ($this->sendOtpEmail($email, $otpCode)) {
            return redirect('/lupapassword/verify?email=' . urlencode($email))->with([
                'message' => 'Kode OTP telah dikirim ke email Anda.',
                'type' => 'success'
            ]);
        } else {
            return redirect('/lupapassword')->with([
                'message' => 'Gagal mengirim OTP. Hubungi support.',
                'type' => 'error'
            ]);
        }
    }

    public function verify(Request $request)
    {
        $email = trim($request->get('email', ''));
        if (empty($email)) {
            $email = trim($request->session()->get('email', ''));
        }
        
        if (empty($email)) {
            return redirect('/lupapassword');
        }

        $data['aktif'] = 'lupapassword';
        $data['email'] = $email;
        $data['message'] = $request->get('message');
        $data['message_type'] = $request->get('type');

        return view('templates.header', $data) .
               view('lupapassword.verify', $data) .
               view('templates.footer');
    }

    public function submitOtp(Request $request)
    {
        $email = trim($request->input('email', ''));
        $kodeOtp = trim($request->input('kode_otp', ''));

        if (empty($email) || empty($kodeOtp)) {
            return redirect("/lupapassword/verify?email=" . urlencode($email))->with([
                'message' => 'Email dan kode OTP wajib diisi.',
                'type' => 'error'
            ]);
        }

        $otpModel = $this->model('OtpModel');
        $otp = $otpModel->getActiveOtp($email, $kodeOtp);

        if (!$otp || strtotime($otp['waktu_kadaluarsa']) < time()) {
            return redirect("/lupapassword/verify?email=" . urlencode($email))->with([
                'message' => 'Kode OTP tidak valid atau sudah kadaluarsa.',
                'type' => 'error'
            ]);
        }

        $otpModel->useOtp($otp['otp_id']);
        $akunModel = $this->model('AkunModel');
        $user = $akunModel->getAkunByEmail($email);

        $_SESSION['password_reset_akun_id'] = $user['akun_id'];
        $_SESSION['password_reset_email'] = $email;

        return redirect('/lupapassword/reset');
    }

    public function reset(Request $request)
    {
        if (empty($_SESSION['password_reset_akun_id'])) {
            return redirect('/lupapassword')->with([
                'message' => 'Silakan verifikasi OTP terlebih dahulu.',
                'type' => 'error'
            ]);
        }

        if ($request->isMethod('POST')) {
            $password = $request->input('password');
            $confirm_password = $request->input('confirm_password');

            if ($password !== $confirm_password) {
                return back()->with([
                    'message' => 'Password tidak cocok.',
                    'type' => 'error'
                ]);
            }

            $akunModel = $this->model('AkunModel');
            if ($akunModel->updatePassword($_SESSION['password_reset_akun_id'], $password)) {
                unset($_SESSION['password_reset_akun_id']);
                unset($_SESSION['password_reset_email']);
                
                return redirect('/login')->with([
                    'message' => 'Password berhasil direset. Silakan login.',
                    'type' => 'success'
                ]);
            }

            return back()->with([
                'message' => 'Gagal memperbarui password. Silakan coba lagi.',
                'type' => 'error'
            ]);
        }

        $data['aktif'] = 'lupapassword';
        return view('templates.header', $data) .
               view('lupapassword.reset', $data) .
               view('templates.footer');
    }

    protected function sendOtpEmail($email, $otpCode)
    {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_SMTP_SECURE', 'ssl');
            $mail->Port = env('MAIL_PORT');

            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($email);
            $mail->Subject = 'Kode OTP Verifikasi';
            $mail->Body = "Kode OTP Anda adalah: <strong>$otpCode</strong>";
            $mail->isHTML(true);

            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
}
