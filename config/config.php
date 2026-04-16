<?php

// 1. Cek apakah server menggunakan HTTPS (biasanya di hosting) atau HTTP (biasanya di localhost)
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://";

// 2. Ambil nama host/domain secara otomatis (akan berisi 'localhost' jika di lokal, atau 'namadomain.com' jika di hosting)
$host = $_SERVER['HTTP_HOST'];

// 3. Gabungkan menjadi BASEURL yang dinamis
define('BASEURL', $protocol . $host);

// Pengaturan Database
// Isi nilai berikut dengan data MySQL dari provider hosting gratis seperti filess.io.
// Contoh yang benar: host tanpa http://, port MySQL, username, password, dan nama database.
define('DB_HOST', 'sq-7tm.h.filess.io');
define('DB_PORT', '61002');
define('DB_USER', 'pemweb_properlyby');
define('DB_PASS', '94da42107be4051036514940cf31d63f1b52dc13');
define('DB_NAME', 'pemweb_properlyby');

define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 465);
define('MAIL_USERNAME', 'your-email@gmail.com');
define('MAIL_PASSWORD', 'your-app-password');
define('MAIL_FROM', 'your-email@gmail.com');
define('MAIL_FROM_NAME', 'Valora Support');
define('MAIL_SMTP_SECURE', 'ssl');

?>