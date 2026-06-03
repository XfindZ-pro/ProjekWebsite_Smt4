<?php

class OrderModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function generateOrderId()
    {
        $conn = $this->db->conn();
        if (!$conn) return 'order00001';

        $stmt = $conn->prepare("SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && preg_match('/^(order)(\d+)$/', $row['order_id'], $matches)) {
            $number = (int) $matches[2] + 1;
        } else {
            $number = 1;
        }

        return 'order' . str_pad($number, 5, "0", STR_PAD_LEFT);
    }

    public function generateTransaksiId()
    {
        $conn = $this->db->conn();
        if (!$conn) return 'trx00001';

        $stmt = $conn->prepare("SELECT transaksi_id FROM transaksi ORDER BY transaksi_id DESC LIMIT 1");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && preg_match('/^(trx)(\d+)$/', $row['transaksi_id'], $matches)) {
            $number = (int) $matches[2] + 1;
        } else {
            $number = 1;
        }

        return 'trx' . str_pad($number, 5, "0", STR_PAD_LEFT);
    }

    public function buatOrder($data)
    {
        $conn = $this->db->conn();
        if (!$conn) return false;

        try {
            $conn->beginTransaction();

            $order_id = $this->generateOrderId();
            $transaksi_id = $this->generateTransaksiId();

            // 1. Insert into orders
            $queryOrder = "INSERT INTO orders (order_id, pembeli_id, total_harga, status_order, alamat_pengiriman, catatan, created_at, updated_at) 
                           VALUES (:order_id, :pembeli_id, :total_harga, 'pending', :alamat_pengiriman, :catatan, NOW(), NOW())";
            $stmtOrder = $conn->prepare($queryOrder);
            $stmtOrder->bindParam(':order_id', $order_id);
            $stmtOrder->bindParam(':pembeli_id', $data['pembeli_id']);
            $stmtOrder->bindParam(':total_harga', $data['total_harga']);
            $stmtOrder->bindParam(':alamat_pengiriman', $data['alamat_pengiriman']);
            $stmtOrder->bindParam(':catatan', $data['catatan']);
            $stmtOrder->execute();

            // 2. Insert into order_items
            $queryItem = "INSERT INTO order_items (order_id, produk_id, jumlah, harga_satuan, subtotal, created_at, updated_at) 
                          VALUES (:order_id, :produk_id, :jumlah, :harga_satuan, :subtotal, NOW(), NOW())";
            $stmtItem = $conn->prepare($queryItem);
            $stmtItem->bindParam(':order_id', $order_id);
            $stmtItem->bindParam(':produk_id', $data['produk_id']);
            $stmtItem->bindParam(':jumlah', $data['jumlah']);
            $stmtItem->bindParam(':harga_satuan', $data['harga_satuan']);
            $stmtItem->bindParam(':subtotal', $data['subtotal']);
            $stmtItem->execute();

            // 3. Insert into transaksi
            $status_pembayaran = ($data['metode_pembayaran'] === 'cod') ? 'belum_bayar' : 'lunas'; // Simulasikan langsung lunas untuk non-COD
            $waktu_bayar = ($status_pembayaran === 'lunas') ? date('Y-m-d H:i:s') : null;

            $queryTrx = "INSERT INTO transaksi (transaksi_id, order_id, metode_pembayaran, status_pembayaran, jumlah_bayar, waktu_bayar, created_at, updated_at) 
                         VALUES (:transaksi_id, :order_id, :metode_pembayaran, :status_pembayaran, :jumlah_bayar, :waktu_bayar, NOW(), NOW())";
            $stmtTrx = $conn->prepare($queryTrx);
            $stmtTrx->bindParam(':transaksi_id', $transaksi_id);
            $stmtTrx->bindParam(':order_id', $order_id);
            $stmtTrx->bindParam(':metode_pembayaran', $data['metode_pembayaran']);
            $stmtTrx->bindParam(':status_pembayaran', $status_pembayaran);
            $stmtTrx->bindParam(':jumlah_bayar', $data['total_harga']);
            $stmtTrx->bindParam(':waktu_bayar', $waktu_bayar);
            $stmtTrx->execute();

            $conn->commit();
            return $order_id;
        } catch (Exception $e) {
            $conn->rollBack();
            error_log("Gagal membuat order: " . $e->getMessage());
            return false;
        }
    }

    public function getOrdersByPembeli($pembeli_id)
    {
        $conn = $this->db->conn();
        if (!$conn) return [];

        try {
            $query = "SELECT o.*, oi.jumlah, oi.harga_satuan, oi.subtotal, k.nama_produk, k.foto_1, t.metode_pembayaran, t.status_pembayaran 
                      FROM orders o 
                      JOIN order_items oi ON o.order_id = oi.order_id 
                      JOIN katalog k ON oi.produk_id = k.produk_id 
                      JOIN transaksi t ON o.order_id = t.order_id 
                      WHERE o.pembeli_id = :pembeli_id 
                      ORDER BY o.created_at DESC";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':pembeli_id', $pembeli_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Gagal mengambil list order pembeli: " . $e->getMessage());
            return [];
        }
    }

    public function getOrdersByPenjual($penjual_id)
    {
        $conn = $this->db->conn();
        if (!$conn) return [];

        try {
            $query = "SELECT o.*, oi.jumlah, oi.harga_satuan, oi.subtotal, k.nama_produk, k.foto_1, t.metode_pembayaran, t.status_pembayaran, a.nama AS nama_pembeli, a.email AS email_pembeli
                      FROM orders o 
                      JOIN order_items oi ON o.order_id = oi.order_id 
                      JOIN katalog k ON oi.produk_id = k.produk_id 
                      JOIN transaksi t ON o.order_id = t.order_id 
                      JOIN akun a ON o.pembeli_id = a.akun_id
                      WHERE k.penjual_id = :penjual_id 
                      ORDER BY o.created_at DESC";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':penjual_id', $penjual_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Gagal mengambil list order penjual: " . $e->getMessage());
            return [];
        }
    }

    public function updateOrderStatus($order_id, $status)
    {
        $conn = $this->db->conn();
        if (!$conn) return false;

        try {
            $query = "UPDATE orders SET status_order = :status_order, updated_at = NOW() WHERE order_id = :order_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':status_order', $status);
            $stmt->bindParam(':order_id', $order_id);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Gagal update status order: " . $e->getMessage());
            return false;
        }
    }
}
