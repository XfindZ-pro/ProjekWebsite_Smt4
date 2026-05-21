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
}
