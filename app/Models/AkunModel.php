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

        $query = "INSERT INTO verifikasi_bisnis (verifikasi_id, akun_id, jenis_entitas, nama_usaha, file_ktp, file_izin_usaha, alamat_usaha, nomor_telepon) VALUES (:verifikasi_id, :akun_id, :jenis_entitas, :nama_usaha, :file_ktp, :file_izin_usaha, :alamat_usaha, :nomor_telepon)";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':verifikasi_id', $verifikasi_id);
        $stmt->bindParam(':akun_id', $data['akun_id']);
        $stmt->bindParam(':jenis_entitas', $data['jenis_entitas']);
        $stmt->bindParam(':nama_usaha', $data['nama_usaha']);
        $stmt->bindValue(':file_ktp', $data['file_ktp'], PDO::PARAM_LOB);
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

    public function setResetToken($akun_id, $token, $expiry) {
        $query = "UPDATE akun SET reset_token = :token, reset_expiry = :expiry WHERE akun_id = :akun_id";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expiry', $expiry);
        $stmt->bindParam(':akun_id', $akun_id);
        return $stmt->execute();
    }

    public function getUserByResetToken($token) {
        $query = "SELECT * FROM akun WHERE reset_token = :token";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($akun_id, $password) {
        $query = "UPDATE akun SET password = :password WHERE akun_id = :akun_id";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':akun_id', $akun_id);
        return $stmt->execute();
    }

    public function clearResetToken($akun_id) {
        $query = "UPDATE akun SET reset_token = NULL, reset_expiry = NULL WHERE akun_id = :akun_id";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':akun_id', $akun_id);
        return $stmt->execute();
    }

    public function expireOtpsByEmail($email) {
        $query = "UPDATE otp_verifikasi SET status = 'terpakai' WHERE email = :email AND status = 'aktif'";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function createOtp($email, $kodeOtp, $expiry) {
        $query = "INSERT INTO otp_verifikasi (email, kode_otp, status, waktu_dibuat, waktu_kadaluarsa) VALUES (:email, :kode_otp, 'aktif', NOW(), :expiry)";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':kode_otp', $kodeOtp);
        $stmt->bindParam(':expiry', $expiry);
        return $stmt->execute();
    }

    public function getActiveOtp($email, $kodeOtp) {
        $query = "SELECT * FROM otp_verifikasi WHERE email = :email AND kode_otp = :kode_otp AND status = 'aktif'";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':kode_otp', $kodeOtp);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function useOtp($otp_id) {
        $query = "UPDATE otp_verifikasi SET status = 'terpakai' WHERE otp_id = :otp_id";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':otp_id', $otp_id);
        return $stmt->execute();
    }

 // ==========================================
    // FUNGSI STATISTIK UNTUK DASHBOARD ADMIN
    // ==========================================

    // 1. Menghitung total semua pengguna (Semua role)
    public function countUsers() {
        try {
            $stmt = $this->db->conn()->prepare("SELECT COUNT(*) AS total FROM akun");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    // 3. Menghitung total produk aktif di tabel katalog
    public function countActiveProducts() {
        try {
            $stmt = $this->db->conn()->prepare("SELECT COUNT(*) AS total FROM katalog");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (Exception $e) {
            // Jika tabel katalog belum dibuat di database, akan mengembalikan 0 tanpa membuat halaman error
            return 0; 
        }
    }

    // 4. Menghitung verifikasi yang disetujui pada hari ini
    public function countApprovedToday() {
        try {
            // Memanfaatkan fungsi CURDATE() dari MySQL untuk mengecek update hari ini
            $stmt = $this->db->conn()->prepare("SELECT COUNT(*) AS total FROM akun WHERE status_verifikasi = 'disetujui' AND DATE(updated_at) = CURDATE()");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function countPendingVerifications() {
        try {
            $stmt = $this->db->conn()->prepare("SELECT COUNT(*) AS total FROM akun WHERE status_verifikasi = 'menunggu'");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function countAllVerifications() {
        try {
            $stmt = $this->db->conn()->prepare("SELECT COUNT(*) AS total FROM verifikasi_bisnis");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getRecentVerifications($limit = 3) {
        try {
            $query = "SELECT v.nama_usaha, a.nama AS penjual, v.jenis_entitas FROM verifikasi_bisnis v JOIN akun a ON v.akun_id = a.akun_id ORDER BY v.verifikasi_id DESC LIMIT :limit";
            $stmt = $this->db->conn()->prepare($query);
            $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    // Ambil semua daftar pengajuan verifikasi yang masuk
    public function getPendingVerifications() {
        try {
            $query = "SELECT v.*, a.nama as nama_user, a.email 
                      FROM verifikasi_bisnis v 
                      JOIN akun a ON v.akun_id = a.akun_id 
                      ORDER BY v.tanggal_pengajuan DESC";
            
            $stmt = $this->db->conn()->prepare($query);
            $stmt->execute();
            
            // Gunakan fetchAll(PDO::FETCH_ASSOC) untuk mengambil banyak baris data
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    // Logika Persetujuan (Hapus data verifikasi & Update status akun)
    public function approveVerification($verifikasi_id, $akun_id) {
        try {
            // 1. Update status di tabel akun
            $query1 = "UPDATE akun SET status_verifikasi = 'disetujui' WHERE akun_id = :akun_id";
            $stmt1 = $this->db->conn()->prepare($query1);
            $stmt1->bindParam(':akun_id', $akun_id);
            $stmt1->execute();

            // 2. Hapus data dari tabel verifikasi_bisnis (agar memori LONGBLOB tidak bengkak)
            $query2 = "DELETE FROM verifikasi_bisnis WHERE verifikasi_id = :v_id";
            $stmt2 = $this->db->conn()->prepare($query2);
            $stmt2->bindParam(':v_id', $verifikasi_id);
            $stmt2->execute();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // Logika Penolakan (Hapus data verifikasi & Set status ditolak)
    public function rejectVerification($verifikasi_id, $akun_id) {
        try {
            // 1. Set status ditolak di tabel akun
            $query1 = "UPDATE akun SET status_verifikasi = 'ditolak' WHERE akun_id = :akun_id";
            $stmt1 = $this->db->conn()->prepare($query1);
            $stmt1->bindParam(':akun_id', $akun_id);
            $stmt1->execute();

            // 2. Hapus data pengajuan
            $query2 = "DELETE FROM verifikasi_bisnis WHERE verifikasi_id = :v_id";
            $stmt2 = $this->db->conn()->prepare($query2);
            $stmt2->bindParam(':v_id', $verifikasi_id);
            $stmt2->execute();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

   

 


}
