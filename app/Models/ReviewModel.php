<?php

class ReviewModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addReview($data)
    {
        $conn = $this->db->conn();
        if (!$conn) return false;

        try {
            $query = "INSERT INTO reviews (order_id, produk_id, pembeli_id, rating, komentar, created_at, updated_at) 
                      VALUES (:order_id, :produk_id, :pembeli_id, :rating, :komentar, NOW(), NOW())";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':order_id', $data['order_id']);
            $stmt->bindParam(':produk_id', $data['produk_id']);
            $stmt->bindParam(':pembeli_id', $data['pembeli_id']);
            $stmt->bindParam(':rating', $data['rating'], PDO::PARAM_INT);
            $stmt->bindValue(':komentar', $data['komentar']);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Gagal menambahkan review: " . $e->getMessage());
            return false;
        }
    }

    public function getReviewsByPembeli($pembeli_id)
    {
        $conn = $this->db->conn();
        if (!$conn) return [];

        try {
            $query = "SELECT * FROM reviews WHERE pembeli_id = :pembeli_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':pembeli_id', $pembeli_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Gagal mengambil reviews pembeli: " . $e->getMessage());
            return [];
        }
    }

    public function getReviewsByProdukPaginated($produk_id, $page = 1, $limit = 10)
    {
        $conn = $this->db->conn();
        if (!$conn) return ['data' => [], 'total' => 0, 'pages' => 0];

        $offset = ($page - 1) * $limit;

        try {
            // Count query - Exclude self-reviews from the seller
            $countQuery = "SELECT COUNT(*) as total 
                           FROM reviews r
                           JOIN katalog k ON r.produk_id = k.produk_id
                           WHERE r.produk_id = :produk_id AND r.pembeli_id != k.penjual_id";
            $stmtCount = $conn->prepare($countQuery);
            $stmtCount->bindValue(':produk_id', $produk_id);
            $stmtCount->execute();
            $total = (int) ($stmtCount->fetch(PDO::FETCH_ASSOC)['total'] ?? 0);
            $pages = (int) ceil($total / $limit);

            // Data query - Exclude self-reviews from the seller
            $query = "SELECT r.*, a.nama AS nama_pembeli, a.foto_profil AS foto_pembeli 
                      FROM reviews r
                      JOIN akun a ON r.pembeli_id = a.akun_id
                      JOIN katalog k ON r.produk_id = k.produk_id
                      WHERE r.produk_id = :produk_id AND r.pembeli_id != k.penjual_id
                      ORDER BY r.created_at DESC
                      LIMIT :limit OFFSET :offset";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':produk_id', $produk_id);
            $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'data' => $data,
                'total' => $total,
                'pages' => $pages,
                'current_page' => $page
            ];
        } catch (Exception $e) {
            error_log("Gagal mengambil reviews produk paginated: " . $e->getMessage());
            return ['data' => [], 'total' => 0, 'pages' => 0, 'current_page' => $page];
        }
    }

    public function getAverageRatingAndCount($produk_id)
    {
        $conn = $this->db->conn();
        if (!$conn) return ['rating' => 0.0, 'count' => 0];

        try {
            // Exclude self-reviews from the seller
            $query = "SELECT AVG(r.rating) as avg_rating, COUNT(*) as total_count 
                      FROM reviews r
                      JOIN katalog k ON r.produk_id = k.produk_id
                      WHERE r.produk_id = :produk_id AND r.pembeli_id != k.penjual_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':produk_id', $produk_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return [
                'rating' => isset($row['avg_rating']) ? round(floatval($row['avg_rating']), 1) : 0.0,
                'count' => intval($row['total_count'] ?? 0)
            ];
        } catch (Exception $e) {
            return ['rating' => 0.0, 'count' => 0];
        }
    }

    public function getReviewByOrderAndProduct($order_id, $produk_id)
    {
        $conn = $this->db->conn();
        if (!$conn) return null;

        try {
            $query = "SELECT * FROM reviews WHERE order_id = :order_id AND produk_id = :produk_id LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':order_id', $order_id);
            $stmt->bindParam(':produk_id', $produk_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }

    public function updateReview($data)
    {
        $conn = $this->db->conn();
        if (!$conn) return false;

        try {
            $query = "UPDATE reviews 
                      SET rating = :rating, komentar = :komentar, updated_at = NOW() 
                      WHERE order_id = :order_id AND produk_id = :produk_id AND pembeli_id = :pembeli_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':order_id', $data['order_id']);
            $stmt->bindParam(':produk_id', $data['produk_id']);
            $stmt->bindParam(':pembeli_id', $data['pembeli_id']);
            $stmt->bindParam(':rating', $data['rating'], PDO::PARAM_INT);
            $stmt->bindValue(':komentar', $data['komentar']);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Gagal memperbarui ulasan: " . $e->getMessage());
            return false;
        }
    }
}

