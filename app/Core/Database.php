<?php

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh; // Database Handler
    private $stmt; // Statement
    public $isConnected = false; // Variabel untuk menyimpan status koneksi

    public function __construct() {
        // Data Source Name (DSN)
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        // Optimasi PDO
        $option = [
            PDO::ATTR_PERSISTENT => true, // Menjaga koneksi tetap terbuka (hemat resource)
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Mode error exception
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
            $this->isConnected = true; // Jika sukses, set true
        } catch(PDOException $e) {
            $this->isConnected = false; // Jika gagal (database belum ada/salah password), set false
            // Kita tidak menggunakan die() di sini agar website tetap bisa dimuat untuk menampilkan error visual
        }
    }

    // Nanti di bawah sini kita bisa tambahkan fungsi query(), bind(), dan execute() untuk CRUD data
}