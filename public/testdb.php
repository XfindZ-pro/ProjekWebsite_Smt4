<?php
$conn = mysqli_connect(
    'sq-7tm.h.filess.io',
    'pemweb_properlyby',
    '94da42107be4051036514940cf31d63f1b52dc13',
    'pemweb_properlyby',
    61002
);

if ($conn) {
    echo "✅ Koneksi berhasil!";
} else {
    echo "❌ Gagal: " . mysqli_connect_error();
}
?>