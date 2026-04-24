<?php

class OtpModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function expireOtpsByEmail($email)
    {
        $query = "UPDATE otp_verifikasi SET status = 'terpakai' WHERE email = :email AND status = 'aktif'";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function createOtp($email, $kodeOtp, $expiry)
    {
        $query = "INSERT INTO otp_verifikasi (email, kode_otp, status, waktu_dibuat, waktu_kadaluarsa) VALUES (:email, :kode_otp, 'aktif', NOW(), :expiry)";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':kode_otp', $kodeOtp);
        $stmt->bindParam(':expiry', $expiry);
        return $stmt->execute();
    }

    public function getActiveOtp($email, $kodeOtp)
    {
        $query = "SELECT * FROM otp_verifikasi WHERE email = :email AND kode_otp = :kode_otp AND status = 'aktif'";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':kode_otp', $kodeOtp);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function useOtp($otp_id)
    {
        $query = "UPDATE otp_verifikasi SET status = 'terpakai' WHERE otp_id = :otp_id";
        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':otp_id', $otp_id);
        return $stmt->execute();
    }
}
