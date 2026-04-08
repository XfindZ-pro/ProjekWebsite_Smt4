<?php
// router.php - Pengganti .htaccess untuk PHP CLI Server

// 1. Ambil path dari URL yang diketik pengguna
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 2. Jika yang diminta adalah file statis (seperti gambar, CSS, JS) dan file itu benar-benar ada,
// maka biarkan PHP Built-in server menampilkannya secara normal (return false).
if (file_exists(__DIR__ . $path) && is_file(__DIR__ . $path)) {
    return false;
}

// 3. Jika file tidak ada (berarti itu adalah rute MVC seperti /login atau /katalog),
// bersihkan garis miring (/) di awal dan akhir URL.
$url = trim($path, '/');

// 4. Masukkan ke dalam $_GET['url'] agar bisa ditangkap oleh file app/Core/App.php kamu
if (!empty($url)) {
    $_GET['url'] = $url;
}

// 5. Lempar semua permintaan ke index.php
require_once __DIR__ . '/index.php';