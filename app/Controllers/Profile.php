<?php

class Profile extends Controller {
    public function index() {
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
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $data['aktif'] = 'profile';
        $data['user'] = $user;

        $this->view('templates/header', $data);
        $this->view('profile/index', $data);
        $this->view('templates/footer');
    }

    public function updatePhoto() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL);
            exit;
        }

        if (!isset($_SESSION['user_akun_id'])) {
            echo json_encode(['success' => false, 'message' => 'Sesi login tidak valid.']);
            exit;
        }

        $photoType = $_POST['photo_type'] ?? '';
        if (!in_array($photoType, ['profil', 'banner'], true)) {
            echo json_encode(['success' => false, 'message' => 'Tipe foto tidak valid.']);
            exit;
        }

        if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['success' => false, 'message' => 'Gagal mengunggah file.']);
            exit;
        }

        $imageInfo = getimagesize($_FILES['photo']['tmp_name']);
        if (!$imageInfo) {
            echo json_encode(['success' => false, 'message' => 'File bukan gambar yang valid.']);
            exit;
        }

        $allowedTypes = [IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png', IMAGETYPE_GIF => 'gif'];
        if (!isset($allowedTypes[$imageInfo[2]])) {
            echo json_encode(['success' => false, 'message' => 'Format gambar tidak didukung.']);
            exit;
        }

        $extension = $allowedTypes[$imageInfo[2]];
        $pathField = $photoType === 'profil' ? 'foto_profil' : 'foto_banner';
        $akunId = $_SESSION['user_akun_id'];

        $imageData = file_get_contents($_FILES['photo']['tmp_name']);
        if ($imageData === false) {
            echo json_encode(['success' => false, 'message' => 'Gagal membaca file gambar.']);
            exit;
        }

        $akunModel = $this->model('AkunModel');
        if (!$akunModel->updateFoto($akunId, $pathField, $imageData, true)) {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data foto ke database.']);
            exit;
        }

        if ($photoType === 'profil') {
            $imageInfo = @getimagesizefromstring($imageData);
            if ($imageInfo) {
                $_SESSION['user_foto'] = 'data:' . $imageInfo['mime'] . ';base64,' . base64_encode($imageData);
            }
        }

        echo json_encode(['success' => true, 'message' => 'Foto berhasil diperbarui.']);
        exit;
    }
}
