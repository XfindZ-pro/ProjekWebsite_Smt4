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

        $resetToken = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        if (!$akunModel->setResetToken($user['akun_id'], $resetToken, $expiry)) {
            header('Location: ' . BASEURL . '/lupapassword?message=' . rawurlencode('Gagal memproses permintaan. Coba lagi.') . '&type=error');
            exit;
        }

        $resetLink = BASEURL . '/lupapassword/reset?token=' . $resetToken;

        if ($this->sendResetEmail($email, $resetLink)) {
            header('Location: ' . BASEURL . '/lupapassword?message=' . rawurlencode('Link reset password telah dikirim ke email Anda.') . '&type=success');
        } else {
            header('Location: ' . BASEURL . '/lupapassword?message=' . rawurlencode('Gagal mengirim email. Hubungi support.') . '&type=error');
        }
        exit;
    }

    public function reset() {
        $token = $_GET['token'] ?? '';
        if (empty($token)) {
            header('Location: ' . BASEURL . '/lupapassword?message=' . rawurlencode('Token tidak valid.') . '&type=error');
            exit;
        }

        $akunModel = $this->model('AkunModel');
        $user = $akunModel->getUserByResetToken($token);

        if (!$user || strtotime($user['reset_expiry']) < time()) {
            header('Location: ' . BASEURL . '/lupapassword?message=' . rawurlencode('Token kadaluarsa atau tidak valid.') . '&type=error');
            exit;
        }

        $data['aktif'] = 'lupapassword';
        $data['token'] = $token;
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

        $token = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if (empty($token) || empty($password) || $password !== $confirmPassword) {
            header('Location: ' . BASEURL . '/lupapassword/reset?token=' . rawurlencode($token) . '&message=' . rawurlencode('Password tidak cocok atau kosong.') . '&type=error');
            exit;
        }

        $akunModel = $this->model('AkunModel');
        $user = $akunModel->getUserByResetToken($token);

        if (!$user || strtotime($user['reset_expiry']) < time()) {
            header('Location: ' . BASEURL . '/lupapassword?message=' . rawurlencode('Token kadaluarsa.') . '&type=error');
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($akunModel->updatePassword($user['akun_id'], $hashedPassword) && $akunModel->clearResetToken($user['akun_id'])) {
            header('Location: ' . BASEURL . '/login?message=' . rawurlencode('Password berhasil diubah. Silakan login.') . '&type=success');
        } else {
            header('Location: ' . BASEURL . '/lupapassword/reset?token=' . rawurlencode($token) . '&message=' . rawurlencode('Gagal mengubah password.') . '&type=error');
        }
        exit;
    }

    private function sendResetEmail($email, $resetLink) {
        require_once __DIR__ . '/../../Libraries/PHPMailer/src/PHPMailer.php';
        require_once __DIR__ . '/../../Libraries/PHPMailer/src/SMTP.php';
        require_once __DIR__ . '/../../Libraries/PHPMailer/src/Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Ganti dengan SMTP server Anda
            $mail->SMTPAuth = true;
            $mail->Username = 'your-email@gmail.com'; // Ganti dengan email Anda
            $mail->Password = 'your-app-password'; // Ganti dengan app password
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('noreply@valora.id', 'Valora Support');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Reset Password - Valora';
            $mail->Body = "
                <h2>Reset Password</h2>
                <p>Klik link berikut untuk reset password Anda:</p>
                <a href='$resetLink'>$resetLink</a>
                <p>Link ini berlaku selama 1 jam.</p>
            ";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
