<?php

class AkunModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // 1. Cek Duplikat Email
    public function cekEmail($email) {
        $stmt = $this->db->conn()->prepare("SELECT email FROM akun WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0; 
    }

    // 2. Generate ID 
    public function generateId() {
        $stmt = $this->db->conn()->prepare("SELECT akun_id FROM akun ORDER BY akun_id DESC LIMIT 1");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $lastId = $row['akun_id'];
            $number = (int) substr($lastId, 4); 
            $number++;
        } else {
            $number = 1;
        }

        return 'akun' . str_pad($number, 6, "0", STR_PAD_LEFT);
    }

    // 3. Simpan Data Register
    public function tambahAkun($data) {
        $akun_id = $this->generateId();
        $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);
        $peran = 'pengguna';
        $foto_profil = null;
        $foto_banner = null;

        $query = "INSERT INTO akun (akun_id, nama, email, password, peran, foto_profil, foto_banner) 
                  VALUES (:akun_id, :nama, :email, :password, :peran, :foto_profil, :foto_banner)";
        
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':akun_id', $akun_id);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':peran', $peran);
        $stmt->bindParam(':foto_profil', $foto_profil, PDO::PARAM_NULL);
        $stmt->bindParam(':foto_banner', $foto_banner, PDO::PARAM_NULL);

        return $stmt->execute();
    }

    // 4. INI FUNGSI YANG BIKIN ERROR TADI (Pastikan ditambahkan)
    public function getAkunByEmail($email) {
        $stmt = $this->db->conn()->prepare("SELECT * FROM akun WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    public function getAkunById($akun_id) {
        $stmt = $this->db->conn()->prepare("SELECT * FROM akun WHERE akun_id = :akun_id");
        $stmt->bindParam(':akun_id', $akun_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAkunByNama($nama) {
        $stmt = $this->db->conn()->prepare("SELECT * FROM akun WHERE nama = :nama LIMIT 1");
        $stmt->bindParam(':nama', $nama);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateFoto($akun_id, $field, $value, $isBlob = false) {
        $allowed = ['foto_profil', 'foto_banner'];
        if (!in_array($field, $allowed, true)) {
            return false;
        }

        $query = "UPDATE akun SET {$field} = :value WHERE akun_id = :akun_id";
        $stmt = $this->db->conn()->prepare($query);
        if ($isBlob) {
            $stmt->bindValue(':value', $value, PDO::PARAM_LOB);
        } else {
            $stmt->bindValue(':value', $value);
        }
        $stmt->bindParam(':akun_id', $akun_id);
        return $stmt->execute();
    }

    public function generateVerifikasiId() {
        $stmt = $this->db->conn()->prepare("SELECT verifikasi_id FROM verifikasi_bisnis ORDER BY verifikasi_id DESC LIMIT 1");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && preg_match('/^(verif)(\d+)$/', $row['verifikasi_id'], $matches)) {
            $number = (int) $matches[2] + 1;
        } else {
            $number = 1;
        }

        return 'verif' . str_pad($number, 9, '0', STR_PAD_LEFT);
    }

    public function ajukanVerifikasi($data) {
        $verifikasi_id = $this->generateVerifikasiId();

        $query = "INSERT INTO verifikasi_bisnis (verifikasi_id, akun_id, jenis_entitas, nama_usaha, nik_penanggungjawab, file_ktp, nomor_izin_usaha, file_izin_usaha, alamat_usaha, nomor_telepon) VALUES (:verifikasi_id, :akun_id, :jenis_entitas, :nama_usaha, :nik_penanggungjawab, :file_ktp, :nomor_izin_usaha, :file_izin_usaha, :alamat_usaha, :nomor_telepon)";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':verifikasi_id', $verifikasi_id);
        $stmt->bindParam(':akun_id', $data['akun_id']);
        $stmt->bindParam(':jenis_entitas', $data['jenis_entitas']);
        $stmt->bindParam(':nama_usaha', $data['nama_usaha']);
        $stmt->bindParam(':nik_penanggungjawab', $data['nik_penanggungjawab']);
        $stmt->bindValue(':file_ktp', $data['file_ktp'], PDO::PARAM_LOB);
        $stmt->bindParam(':nomor_izin_usaha', $data['nomor_izin_usaha']);
        $stmt->bindValue(':file_izin_usaha', $data['file_izin_usaha'], PDO::PARAM_LOB);
        $stmt->bindParam(':alamat_usaha', $data['alamat_usaha']);
        $stmt->bindParam(':nomor_telepon', $data['nomor_telepon']);

        return $stmt->execute();
    }

    public function updateStatusVerifikasi($akun_id, $status) {
        $query = "UPDATE akun SET status_verifikasi = :status WHERE akun_id = :akun_id";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':akun_id', $akun_id);
        return $stmt->execute();
    }
}
