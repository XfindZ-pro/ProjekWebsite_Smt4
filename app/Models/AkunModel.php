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

        $query = "INSERT INTO akun (akun_id, nama, email, password, peran, foto_profil) 
                  VALUES (:akun_id, :nama, :email, :password, :peran, :foto_profil)";
        
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':akun_id', $akun_id);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':peran', $peran);
        $stmt->bindParam(':foto_profil', $foto_profil, PDO::PARAM_NULL);

        return $stmt->execute();
    }

    // 4. INI FUNGSI YANG BIKIN ERROR TADI (Pastikan ditambahkan)
    public function getAkunByEmail($email) {
        $stmt = $this->db->conn()->prepare("SELECT * FROM akun WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
}