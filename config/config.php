<?php

// 1. Cek apakah server menggunakan HTTPS (biasanya di hosting) atau HTTP (biasanya di localhost)
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://";

// 2. Ambil nama host/domain secara otomatis (akan berisi 'localhost' jika di lokal, atau 'namadomain.com' jika di hosting)
$host = $_SERVER['HTTP_HOST'];

// 3. Gabungkan menjadi BASEURL yang dinamis
define('BASEURL', $protocol . $host);

// Pengaturan Database
// Catatan: Saat nanti diupload ke hosting, pastikan kamu juga menggabungkan/menyesuaikan username, password, dan nama DB ini sesuai dengan yang diberikan oleh pihak hosting.
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'pemweb');

?>