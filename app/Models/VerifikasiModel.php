<?php

class VerifikasiModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function generateVerifikasiId()
    {
        do {
            $angka_acak = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $id_baru = 'verifikasiakun' . $angka_acak;
            $stmt = $this->db->conn()->prepare("SELECT verifikasi_id FROM verifikasi_bisnis WHERE verifikasi_id = :id");
            $stmt->bindParam(':id', $id_baru);
            $stmt->execute();
        } while ($stmt->rowCount() > 0);

        return $id_baru;
    }

    public function ajukanVerifikasi($data)
    {
        try {
            $verifikasi_id = $this->generateVerifikasiId();
            $query = "INSERT INTO verifikasi_bisnis (
                        verifikasi_id, akun_id, jenis_entitas, nama_usaha, file_ktp, file_izin_usaha, alamat_usaha, nomor_telepon
                      ) VALUES (
                        :verifikasi_id, :akun_id, :jenis_entitas, :nama_usaha, :file_ktp, :file_izin_usaha, :alamat_usaha, :nomor_telepon
                      )";

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
        } catch (PDOException $e) {
            error_log("Gagal ajukan verifikasi: " . $e->getMessage());
            return false;
        }
    }

    public function updateStatusVerifikasi($akun_id, $status)
    {
        $query = "UPDATE akun SET status_verifikasi = :status WHERE akun_id = :akun_id";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':akun_id', $akun_id);
        return $stmt->execute();
    }

    public function countPendingVerifications()
    {
        try {
            $stmt = $this->db->conn()->prepare("SELECT COUNT(*) AS total FROM akun WHERE status_verifikasi = 'menunggu'");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function countAllVerifications()
    {
        try {
            $stmt = $this->db->conn()->prepare("SELECT COUNT(*) AS total FROM verifikasi_bisnis");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getRecentVerifications($limit = 3)
    {
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

    public function getPendingVerifications()
    {
        try {
            $query = "SELECT v.*, a.nama as nama_user, a.email 
                      FROM verifikasi_bisnis v 
                      JOIN akun a ON v.akun_id = a.akun_id 
                      ORDER BY v.tanggal_pengajuan DESC";
            $stmt = $this->db->conn()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function approveVerification($verifikasi_id, $akun_id)
    {
        try {
            $query1 = "UPDATE akun SET status_verifikasi = 'disetujui' WHERE akun_id = :akun_id";
            $stmt1 = $this->db->conn()->prepare($query1);
            $stmt1->bindParam(':akun_id', $akun_id);
            $stmt1->execute();

            $query2 = "DELETE FROM verifikasi_bisnis WHERE verifikasi_id = :v_id";
            $stmt2 = $this->db->conn()->prepare($query2);
            $stmt2->bindParam(':v_id', $verifikasi_id);
            $stmt2->execute();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function rejectVerification($verifikasi_id, $akun_id)
    {
        try {
            $query1 = "UPDATE akun SET status_verifikasi = 'ditolak' WHERE akun_id = :akun_id";
            $stmt1 = $this->db->conn()->prepare($query1);
            $stmt1->bindParam(':akun_id', $akun_id);
            $stmt1->execute();

            $query2 = "DELETE FROM verifikasi_bisnis WHERE verifikasi_id = :v_id";
            $stmt2 = $this->db->conn()->prepare($query2);
            $stmt2->bindParam(':v_id', $verifikasi_id);
            $stmt2->execute();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function countApprovedToday()
    {
        try {
            $stmt = $this->db->conn()->prepare("SELECT COUNT(*) AS total FROM akun WHERE status_verifikasi = 'disetujui' AND DATE(updated_at) = CURDATE()");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (Exception $e) {
            return 0;
        }
    }
}
