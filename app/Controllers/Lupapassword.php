<?php

class Lupapassword extends Controller {
    public function index() {
        $data['aktif'] = 'lupapassword';
        $data['message'] = $_GET['message'] ?? null;
        $data['message_type'] = $_GET['type'] ?? null;

        $this->view('templates/header', $data);
        $this->view('lupapassword/index', $data);
        $this->view('templates/footer');
    }

    public function sendReset() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL . '/lupapassword');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: ' . BASEURL . '/lupapassword?message=' . rawurlencode('Email tidak valid.') . '&type=error');
            exit;
        }

        $akunModel = $this->model('AkunModel');
        $user = $akunModel->getAkunByEmail($email);

        if (!$user) {
            header('Location: ' . BASEURL . '/lupapassword?message=' . rawurlencode('Email tidak terdaftar.') . '&type=error');
            exit;
        }

        $akunModel->expireOtpsByEmail($email);
        $otpCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiry = date('Y-m-d H:i:s', strtotime('+3 minutes'));

        if (!$akunModel->createOtp($email, $otpCode, $expiry)) {
            header('Location: ' . BASEURL . '/lupapassword?message=' . rawurlencode('Gagal memproses permintaan. Coba lagi.') . '&type=error');
            exit;
        }

        if ($this->sendOtpEmail($email, $otpCode)) {
            header('Location: ' . BASEURL . '/lupapassword/verify?email=' . rawurlencode($email) . '&message=' . rawurlencode('Kode OTP telah dikirim ke email Anda.') . '&type=success');
        } else {
            header('Location: ' . BASEURL . '/lupapassword?message=' . rawurlencode('Gagal mengirim OTP. Hubungi support.') . '&type=error');
        }
        exit;
    }

    public function verify() {
        $email = trim($_GET['email'] ?? '');
        if (empty($email)) {
            header('Location: ' . BASEURL . '/lupapassword');
            exit;
        }

        $data['aktif'] = 'lupapassword';
        $data['email'] = $email;
        $data['message'] = $_GET['message'] ?? null;
        $data['message_type'] = $_GET['type'] ?? null;

        $this->view('templates/header', $data);
        $this->view('lupapassword/verify', $data);
        $this->view('templates/footer');
    }

    public function submitOtp() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL . '/lupapassword');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        $kodeOtp = trim($_POST['kode_otp'] ?? '');

        if (empty($email) || empty($kodeOtp)) {
            header('Location: ' . BASEURL . '/lupapassword/verify?email=' . rawurlencode($email) . '&message=' . rawurlencode('Email dan kode OTP wajib diisi.') . '&type=error');
            exit;
        }

        $akunModel = $this->model('AkunModel');
        $otp = $akunModel->getActiveOtp($email, $kodeOtp);

        if (!$otp || strtotime($otp['waktu_kadaluarsa']) < time()) {
            header('Location: ' . BASEURL . '/lupapassword/verify?email=' . rawurlencode($email) . '&message=' . rawurlencode('Kode OTP tidak valid atau sudah kadaluarsa.') . '&type=error');
            exit;
        }

        $akunModel->useOtp($otp['otp_id']);
        $user = $akunModel->getAkunByEmail($email);

        $_SESSION['password_reset_akun_id'] = $user['akun_id'];
        $_SESSION['password_reset_email'] = $email;

        header('Location: ' . BASEURL . '/lupapassword/reset');
        exit;
    }

    public function resendOtp() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL . '/lupapassword');
            exit;
        }

        $email = trim($_POST['email'] ?? '');
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: ' . BASEURL . '/lupapassword?message=' . rawurlencode('Email tidak valid.') . '&type=error');
            exit;
        }

        $akunModel = $this->model('AkunModel');
        $user = $akunModel->getAkunByEmail($email);

        if (!$user) {
            header('Location: ' . BASEURL . '/lupapassword?message=' . rawurlencode('Email tidak terdaftar.') . '&type=error');
            exit;
        }

        $akunModel->expireOtpsByEmail($email);
        $otpCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiry = date('Y-m-d H:i:s', strtotime('+3 minutes'));
        $akunModel->createOtp($email, $otpCode, $expiry);

        if ($this->sendOtpEmail($email, $otpCode)) {
            header('Location: ' . BASEURL . '/lupapassword/verify?email=' . rawurlencode($email) . '&message=' . rawurlencode('OTP baru telah dikirim ke email Anda.') . '&type=success');
        } else {
            header('Location: ' . BASEURL . '/lupapassword/verify?email=' . rawurlencode($email) . '&message=' . rawurlencode('Gagal mengirim OTP. Hubungi support.') . '&type=error');
        }
        exit;
    }

    public function reset() {
        if (empty($_SESSION['password_reset_akun_id'])) {
            header('Location: ' . BASEURL . '/lupapassword?message=' . rawurlencode('Silakan verifikasi OTP terlebih dahulu.') . '&type=error');
            exit;
        }

        $data['aktif'] = 'lupapassword';
        $data['token'] = null;
        $data['message'] = $_GET['message'] ?? null;
        $data['message_type'] = $_GET['type'] ?? null;

        $this->view('templates/header', $data);
        $this->view('lupapassword/reset', $data);
        $this->view('templates/footer');
    }

    public function updatePassword() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL . '/lupapassword');
            exit;
        }

        if (empty($_SESSION['password_reset_akun_id'])) {
            header('Location: ' . BASEURL . '/lupapassword?message=' . rawurlencode('Silakan verifikasi OTP terlebih dahulu.') . '&type=error');
            exit;
        }

        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if (empty($password) || $password !== $confirmPassword) {
            header('Location: ' . BASEURL . '/lupapassword/reset?message=' . rawurlencode('Password tidak cocok atau kosong.') . '&type=error');
            exit;
        }

        $akunModel = $this->model('AkunModel');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($akunModel->updatePassword($_SESSION['password_reset_akun_id'], $hashedPassword)) {
            unset($_SESSION['password_reset_akun_id'], $_SESSION['password_reset_email']);
            header('Location: ' . BASEURL . '/login?message=' . rawurlencode('Password berhasil diubah. Silakan login.') . '&type=success');
        } else {
            header('Location: ' . BASEURL . '/lupapassword/reset?message=' . rawurlencode('Gagal mengubah password.') . '&type=error');
        }
        exit;
    }

    private function sendOtpEmail($email, $otpCode) {
        $subject = 'Kode OTP Reset Password - Valora';
        $body = "
            <h2>Kode OTP Lupa Password</h2>
            <p>Gunakan kode berikut untuk mereset password Anda:</p>
            <p style='font-size: 24px; font-weight: bold;'>$otpCode</p>
            <p>Kode ini akan kedaluwarsa dalam 3 menit.</p>
        ";

        if (defined('MAIL_HOST') && defined('MAIL_USERNAME') && defined('MAIL_PASSWORD') && defined('MAIL_FROM')) {
            return $this->sendOtpWithSmtp($email, $subject, $body);
        }

        error_log('[OTP] SMTP config not found, trying PHP mail() fallback');
        return $this->sendOtpWithMailFunction($email, $subject, $body);
    }

    private function sendOtpWithSmtp($email, $subject, $body) {
        $host = MAIL_HOST;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;
        $fromName = MAIL_FROM_NAME ?? 'Valora Support';
        $transport = (defined('MAIL_SMTP_SECURE') && MAIL_SMTP_SECURE === 'ssl') ? 'ssl://' : '';
        $remote = sprintf('%s%s:%d', $transport, $host, $port);

        $connection = stream_socket_client($remote, $errno, $errstr, 15);
        if (!$connection) {
            error_log("[OTP] SMTP connect failed: $errno - $errstr");
            return false;
        }

        stream_set_timeout($connection, 15);
        if (!$this->smtpRead($connection, '220')) {
            fclose($connection);
            return false;
        }

        $hostname = $_SERVER['SERVER_NAME'] ?? 'localhost';
        if (!$this->smtpWrite($connection, "EHLO $hostname\r\n", '250')) { fclose($connection); return false; }
        if (!$this->smtpWrite($connection, "AUTH LOGIN\r\n", '334')) { fclose($connection); return false; }
        if (!$this->smtpWrite($connection, base64_encode($username) . "\r\n", '334')) { fclose($connection); return false; }
        if (!$this->smtpWrite($connection, base64_encode($password) . "\r\n", '235')) { fclose($connection); return false; }
        if (!$this->smtpWrite($connection, "MAIL FROM:<$username>\r\n", '250')) { fclose($connection); return false; }
        if (!$this->smtpWrite($connection, "RCPT TO:<$email>\r\n", '250')) { fclose($connection); return false; }
        if (!$this->smtpWrite($connection, "DATA\r\n", '354')) { fclose($connection); return false; }

        $headers = "From: $fromName <$from>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "To: $email\r\n";
        $headers .= "Subject: $subject\r\n";

        $message = $headers . "\r\n" . $body . "\r\n.\r\n";
        if (!$this->smtpWriteRaw($connection, $message, '250')) { fclose($connection); return false; }
        $this->smtpWrite($connection, "QUIT\r\n", '221');
        fclose($connection);

        return true;
    }

    private function sendOtpWithMailFunction($email, $subject, $body) {
        $headers = 'From: Valora Support <' . MAIL_FROM . '>' . "\r\n";
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";

        $result = mail($email, $subject, $body, $headers);
        if (!$result) {
            error_log("[OTP] PHP mail() failed for $email");
        }

        return $result;
    }

    private function smtpRead($connection, $expectedCode) {
        $response = '';
        while (($line = fgets($connection, 515)) !== false) {
            $response .= $line;
            if (isset($line[3]) && $line[3] !== '-') {
                break;
            }
        }

        if (substr($response, 0, 3) !== $expectedCode) {
            error_log("[OTP] SMTP response expected {$expectedCode}, got: {$response}");
            return false;
        }

        return true;
    }

    private function smtpWrite($connection, $command, $expectedCode) {
        fwrite($connection, $command);
        return $this->smtpRead($connection, $expectedCode);
    }

    private function smtpWriteRaw($connection, $data, $expectedCode) {
        fwrite($connection, $data);
        return $this->smtpRead($connection, $expectedCode);
    }
}
