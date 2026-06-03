<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Profile extends Controller
{
    public function index()
    {
        $akunModel = $this->model('AkunModel');
        $user = null;

        if (isset($_SESSION['user_akun_id'])) {
            $user = $akunModel->getAkunById($_SESSION['user_akun_id']);
        }

        if (!$user && isset($_SESSION['user_email'])) {
            $user = $akunModel->getAkunByEmail($_SESSION['user_email']);
        }

        if (!$user && isset($_SESSION['user_nama'])) {
            $user = $akunModel->getAkunByNama($_SESSION['user_nama']);
        }

        if (!$user) {
            return redirect('/login');
        }

        $data['aktif'] = 'profile';
        $data['user'] = $user;

        return view('templates.header', $data) .
               view('profile.index', $data) .
               view('templates.footer');
    }

    public function updatePhoto(Request $request)
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return response()->json(['success' => false, 'message' => 'Sesi login tidak valid.']);
        }

        $photoType = $request->input('photo_type', '');
        
        if (!in_array($photoType, ['profil', 'banner'], true)) {
            return response()->json(['success' => false, 'message' => 'Tipe foto tidak valid.']);
        }

        if (!$request->hasFile('photo')) {
            return response()->json(['success' => false, 'message' => 'Gagal mengunggah file.']);
        }

        $file = $request->file('photo');
        $imageInfo = getimagesize($file->getRealPath());
        
        if (!$imageInfo) {
            return response()->json(['success' => false, 'message' => 'File bukan gambar yang valid.']);
        }

        $allowedTypes = [IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png', IMAGETYPE_GIF => 'gif'];
        
        if (!isset($allowedTypes[$imageInfo[2]])) {
            return response()->json(['success' => false, 'message' => 'Format gambar tidak didukung.']);
        }

        $pathField = $photoType === 'profil' ? 'foto_profil' : 'foto_banner';
        $akunId = $_SESSION['user_akun_id'];

        $imageData = file_get_contents($file->getRealPath());
        
        if ($imageData === false) {
            return response()->json(['success' => false, 'message' => 'Gagal membaca file gambar.']);
        }

        $akunModel = $this->model('AkunModel');
        if (!$akunModel->updateFoto($akunId, $pathField, $imageData, true)) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data foto ke database.']);
        }

        $_SESSION['user_foto'] = 'data:image/jpeg;base64,' . base64_encode($imageData);
        
        return response()->json(['success' => true, 'message' => 'Foto berhasil diperbarui.']);
    }

    public function sendOtp(Request $request)
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return response()->json(['success' => false, 'message' => 'Sesi login tidak valid.']);
        }

        $akunModel = $this->model('AkunModel');
        $user = $akunModel->getAkunById($_SESSION['user_akun_id']);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan.']);
        }

        $email = $user['email'];
        $otpModel = $this->model('OtpModel');
        
        // Batalkan OTP aktif sebelumnya
        $otpModel->expireOtpsByEmail($email);
        
        // Generate 6 digit OTP
        $otpCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Berlaku 1 menit
        $expiry = date('Y-m-d H:i:s', strtotime('+1 minute'));

        if (!$otpModel->createOtp($email, $otpCode, $expiry)) {
            return response()->json(['success' => false, 'message' => 'Gagal memproses kode OTP.']);
        }

        if ($this->sendOtpEmail($email, $otpCode)) {
            return response()->json(['success' => true, 'message' => 'Kode OTP verifikasi email berhasil dikirim.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal mengirim email OTP. Pastikan konfigurasi SMTP benar.']);
        }
    }

    public function verifyOtp(Request $request)
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return response()->json(['success' => false, 'message' => 'Sesi login tidak valid.']);
        }

        $kodeOtp = trim($request->input('kode_otp', ''));
        if (empty($kodeOtp)) {
            return response()->json(['success' => false, 'message' => 'Kode OTP wajib diisi.']);
        }

        $akunModel = $this->model('AkunModel');
        $user = $akunModel->getAkunById($_SESSION['user_akun_id']);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan.']);
        }

        $email = $user['email'];
        $otpModel = $this->model('OtpModel');
        $otp = $otpModel->getActiveOtp($email, $kodeOtp);

        if (!$otp || strtotime($otp['waktu_kadaluarsa']) < time()) {
            return response()->json(['success' => false, 'message' => 'Kode OTP tidak valid atau sudah kadaluarsa (batas waktu 1 menit).']);
        }

        // Gunakan OTP
        $otpModel->useOtp($otp['otp_id']);

        // Update status verifikasi_email
        if ($akunModel->verifyEmail($user['akun_id'])) {
            return response()->json(['success' => true, 'message' => 'Email berhasil diverifikasi!']);
        }

        return response()->json(['success' => false, 'message' => 'Gagal mengubah status verifikasi email.']);
    }

    protected function sendOtpEmail($email, $otpCode)
    {
        try {
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_SMTP_SECURE', 'ssl');
            $mail->Port = env('MAIL_PORT');

            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($email);
            $mail->Subject = 'Kode OTP Verifikasi Email';
            $mail->Body = "Kode OTP verifikasi email Anda adalah: <strong>$otpCode</strong>. Kode ini hanya berlaku selama 1 menit.";
            $mail->isHTML(true);

            return $mail->send();
        } catch (\Exception $e) {
            return false;
        }
    }
}
