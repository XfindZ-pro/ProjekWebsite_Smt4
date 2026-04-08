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
}