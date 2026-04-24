<?php

class ProdukModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function generateProdukId()
    {
        $stmt = $this->db->conn()->prepare("SELECT produk_id FROM katalog ORDER BY produk_id DESC LIMIT 1");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && preg_match('/^(PRD)(\d+)$/', $row['produk_id'], $matches)) {
            $number = (int) $matches[2] + 1;
        } else {
            $number = 1;
        }

        return 'PRD' . str_pad($number, 6, "0", STR_PAD_LEFT);
    }

    public function tambahProduk($data)
    {
        $produk_id = $this->generateProdukId();

        $query = "INSERT INTO katalog (
                    produk_id, penjual_id, nama_produk, kategori_limbah, berat_tersedia, 
                    harga_per_kg, min_order, lokasi_pickup, kondisi_harga, deskripsi, 
                    kondisi_fisik, metode_pengemasan, foto_1, foto_2, foto_3, 
                    dokumen_pendukung, status_produk
                  ) VALUES (
                    :produk_id, :penjual_id, :nama_produk, :kategori_limbah, :berat_tersedia, 
                    :harga_per_kg, :min_order, :lokasi_pickup, :kondisi_harga, :deskripsi, 
                    :kondisi_fisik, :metode_pengemasan, :foto_1, :foto_2, :foto_3, 
                    :dokumen_pendukung, :status_produk
                  )";

        $stmt = $this->db->conn()->prepare($query);
        $stmt->bindParam(':produk_id', $produk_id);
        $stmt->bindParam(':penjual_id', $data['penjual_id']);
        $stmt->bindParam(':nama_produk', $data['nama_produk']);
        $stmt->bindParam(':kategori_limbah', $data['kategori_limbah']);
        $stmt->bindParam(':berat_tersedia', $data['berat_tersedia']);
        $stmt->bindParam(':harga_per_kg', $data['harga_per_kg']);
        $stmt->bindParam(':min_order', $data['min_order']);
        $stmt->bindParam(':lokasi_pickup', $data['lokasi_pickup']);
        $stmt->bindParam(':kondisi_harga', $data['kondisi_harga']);
        $stmt->bindParam(':deskripsi', $data['deskripsi']);
        $stmt->bindParam(':kondisi_fisik', $data['kondisi_fisik']);
        $stmt->bindParam(':metode_pengemasan', $data['metode_pengemasan']);
        $stmt->bindValue(':foto_1', $data['foto_1'], PDO::PARAM_LOB);
        $stmt->bindValue(':foto_2', $data['foto_2'], PDO::PARAM_LOB);
        $stmt->bindValue(':foto_3', $data['foto_3'], PDO::PARAM_LOB);
        $stmt->bindValue(':dokumen_pendukung', $data['dokumen_pendukung'], PDO::PARAM_LOB);
        $stmt->bindParam(':status_produk', $data['status_produk']);

        return $stmt->execute();
    }

    public function countActiveProducts()
    {
        try {
            $stmt = $this->db->conn()->prepare("SELECT COUNT(*) AS total FROM katalog");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getProdukByPenjual($akun_id)
    {
        try {
            $stmt = $this->db->conn()->prepare("SELECT * FROM katalog WHERE penjual_id = :akun_id ORDER BY created_at DESC");
            $stmt->bindParam(':akun_id', $akun_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public function hasProducts($akun_id)
    {
        try {
            $stmt = $this->db->conn()->prepare("SELECT COUNT(*) AS total FROM katalog WHERE penjual_id = :akun_id");
            $stmt->bindParam(':akun_id', $akun_id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return ($result['total'] > 0);
        } catch (Exception $e) {
            return false;
        }
    }

    public function getProdukById($id)
    {
        try {
            $stmt = $this->db->conn()->prepare("SELECT * FROM katalog WHERE produk_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }

    public function updateProduk($data)
    {
        try {
            $query = "UPDATE katalog SET 
                        nama_produk = :nama_produk, 
                        kategori_limbah = :kategori_limbah, 
                        berat_tersedia = :berat_tersedia, 
                        harga_per_kg = :harga_per_kg, 
                        min_order = :min_order, 
                        lokasi_pickup = :lokasi_pickup, 
                        kondisi_harga = :kondisi_harga, 
                        deskripsi = :deskripsi, 
                        kondisi_fisik = :kondisi_fisik, 
                        metode_pengemasan = :metode_pengemasan,
                        status_produk = :status_produk";

            if ($data['foto_1'] !== null) $query .= ", foto_1 = :foto_1";
            if ($data['foto_2'] !== null) $query .= ", foto_2 = :foto_2";
            if ($data['foto_3'] !== null) $query .= ", foto_3 = :foto_3";
            if ($data['dokumen_pendukung'] !== null) $query .= ", dokumen_pendukung = :dokumen_pendukung";

            $query .= " WHERE produk_id = :produk_id AND penjual_id = :penjual_id";

            $stmt = $this->db->conn()->prepare($query);
            $stmt->bindParam(':produk_id', $data['produk_id']);
            $stmt->bindParam(':penjual_id', $data['penjual_id']);
            $stmt->bindParam(':nama_produk', $data['nama_produk']);
            $stmt->bindParam(':kategori_limbah', $data['kategori_limbah']);
            $stmt->bindParam(':berat_tersedia', $data['berat_tersedia']);
            $stmt->bindParam(':harga_per_kg', $data['harga_per_kg']);
            $stmt->bindParam(':min_order', $data['min_order']);
            $stmt->bindParam(':lokasi_pickup', $data['lokasi_pickup']);
            $stmt->bindParam(':kondisi_harga', $data['kondisi_harga']);
            $stmt->bindParam(':deskripsi', $data['deskripsi']);
            $stmt->bindParam(':kondisi_fisik', $data['kondisi_fisik']);
            $stmt->bindParam(':metode_pengemasan', $data['metode_pengemasan']);
            $stmt->bindParam(':status_produk', $data['status_produk']);

            if ($data['foto_1'] !== null) $stmt->bindValue(':foto_1', $data['foto_1'], PDO::PARAM_LOB);
            if ($data['foto_2'] !== null) $stmt->bindValue(':foto_2', $data['foto_2'], PDO::PARAM_LOB);
            if ($data['foto_3'] !== null) $stmt->bindValue(':foto_3', $data['foto_3'], PDO::PARAM_LOB);
            if ($data['dokumen_pendukung'] !== null) $stmt->bindValue(':dokumen_pendukung', $data['dokumen_pendukung'], PDO::PARAM_LOB);

            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function hapusProduk($produk_id, $penjual_id)
    {
        try {
            $stmt = $this->db->conn()->prepare("DELETE FROM katalog WHERE produk_id = :p_id AND penjual_id = :u_id");
            $stmt->bindParam(':p_id', $produk_id);
            $stmt->bindParam(':u_id', $penjual_id);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function getKatalogFilter($filter = [])
    {
        try {
            $conn = $this->db->conn();
            if (!$conn) return [];

            $query = "SELECT * FROM katalog WHERE status_produk = 'aktif'";
            $params = [];

            if (!empty($filter['keyword'])) {
                $query .= " AND (nama_produk LIKE :keyword OR deskripsi LIKE :keyword)";
                $params[':keyword'] = '%' . $filter['keyword'] . '%';
            }

            if (!empty($filter['kategori']) && $filter['kategori'] !== 'semua') {
                $query .= " AND kategori_limbah = :kategori";
                $params[':kategori'] = $filter['kategori'];
            }

            if (!empty($filter['lokasi'])) {
                $query .= " AND lokasi_pickup = :lokasi";
                $params[':lokasi'] = $filter['lokasi'];
            }

            $sort = $filter['sort'] ?? 'terbaru';
            switch ($sort) {
                case 'harga_min': $query .= " ORDER BY harga_per_kg ASC"; break;
                case 'harga_max': $query .= " ORDER BY harga_per_kg DESC"; break;
                default: $query .= " ORDER BY created_at DESC"; break;
            }

            $stmt = $conn->prepare($query);
            foreach ($params as $key => $val) $stmt->bindValue($key, $val);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
            return [];
        }
    }
}
