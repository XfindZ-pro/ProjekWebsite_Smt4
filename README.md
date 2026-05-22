<div align="center">

<!-- Animated Banner -->
<img src="https://capsule-render.vercel.app/api?type=waving&color=gradient&customColorList=6,11,20&height=220&section=header&text=VALORA&fontSize=80&fontColor=ffffff&animation=fadeIn&fontAlignY=38&desc=Marketplace%20Sisa%20Produksi%20&%20Bahan%20Baku%20Industri&descAlignY=60&descAlign=50" width="100%"/>

<!-- Badges -->
<p>
  <img src="https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white"/>
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white"/>
  <img src="https://img.shields.io/badge/Composer-Autoload-885630?style=for-the-badge&logo=composer&logoColor=white"/>
  <img src="https://img.shields.io/badge/Architecture-MVC%20Native-orange?style=for-the-badge"/>
</p>

</div>

---

## 📖 Tentang Valora

**Valora** adalah marketplace berbasis web untuk mempertemukan pemilik sisa produksi industri dengan pelaku usaha yang membutuhkan bahan baku. Aplikasi ini membantu memaksimalkan ekonomi sirkular dengan menyediakan platform jual-beli bahan baku industri dan sisa produksi secara aman.

Aplikasi ini mendukung alur bisnis berikut:
- Pengguna mendaftar dan login untuk akses penuh.
- Pengguna yang ingin berjualan harus mengajukan verifikasi akun dengan dokumen usaha.
- Setelah diverifikasi oleh admin, penjual dapat memasukkan, mengelola, dan menampilkan produk di katalog.
- Pembeli dapat mencari bahan baku sesuai kategori, lokasi pickup, dan harga.
- Admin mengelola proses verifikasi dan memantau data platform.

---

## 🚦 Alur Bisnis Utama

1. Pengguna baru mendaftar melalui halaman `Register`.
2. Setelah login, pengguna dapat mengajukan `Verifikasi Akun` dengan mengunggah KTP dan izin usaha.
3. Admin meninjau pengajuan verifikasi melalui `Dashboard Admin`.
4. Jika disetujui, pengguna dapat mengakses halaman `Jualan` untuk tambah produk.
5. Produk yang aktif akan tampil di `Katalog` dan `Cari Bahan Baku`.
6. Penjual dapat mengelola produk sendiri di `Produksaya` (edit, hapus, ubah status draft/aktif).
7. Jika lupa password, pengguna dapat reset melalui OTP email di halaman `Lupa Password`.

---

## ✨ Fitur Unggulan

### 👤 Akun & Autentikasi
- Register dan login pengguna.
- Reset password menggunakan OTP yang dikirim ke email.
- Profil pengguna dengan pengaturan informasi dan tampilan.

### 🏭 Verifikasi Penjual
- Penjual wajib mengajukan verifikasi dengan KTP dan izin usaha.
- Status verifikasi: `menunggu`, `disetujui`, atau `ditolak`.
- Akun penjual hanya bisa berjualan setelah verifikasi disetujui.

### 📦 Manajemen Produk
- Penjual dapat menambah produk baru melalui halaman `Jualan`.
- Mendukung unggah sampai 3 foto produk dan dokumen pendukung.
- Produk dapat disimpan sebagai `draft` atau ditayangkan sebagai `aktif`.
- Ubah dan hapus produk lewat halaman `Produksaya`.

### 🔎 Pencarian Bahan Baku
- Halaman `Cari Bahan Baku` untuk mencari produk berdasarkan kata kunci.
- Filter kategori limbah, lokasi pickup, dan urutan harga.
- Menampilkan semua produk aktif yang tersedia di katalog.

### 🧑‍💼 Admin Dashboard
- Admin melihat ringkasan pengguna, produk, dan verifikasi.
- Admin menyetujui atau menolak pengajuan verifikasi akun.

---

## 🛠️ Tech Stack

Dibangun menggunakan teknologi native dengan struktur MVC:

- **PHP 8.x**
- **MySQL 8.x**
- **Composer** untuk autoloading dan library management
- **PHPMailer** untuk OTP email
- **Vanilla HTML, CSS, JavaScript** untuk tampilan frontend
- **Pattern**: MVC native dengan controller, model, dan view terpisah

---

## 🗂️ Struktur Folder

```
Valora/
├── app/
│   ├── Controllers/    # Logika aplikasi dan alur rute
│   ├── Core/           # Inti framework: router, controller base, request
│   ├── Models/         # Model data: Akun, Produk, Otp, Verifikasi
│   └── init.php        # Inisialisasi aplikasi
├── config/             # Pengaturan database & SMTP
├── public/             # Entry point aplikasi dan aset publik
├── routes/             # Definisi rute web
├── vendor/             # Library pihak ketiga via Composer
└── views/              # Template dan halaman frontend
```

---

## 🚀 Cara Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/XfindZ-pro/ProjekWebsite_Smt4.git
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Konfigurasi database**
   Sesuaikan `config/config.php` dengan pengaturan MySQL lokal.

4. **SMTP untuk OTP**
   Isi kredensial SMTP Gmail di `config/config.php` jika ingin mengaktifkan reset password via OTP.

---

<div align="center">
  <p>Dibuat untuk Tugas Proyek Semester 4 - Pemrograman Web</p>
  <strong>⭐ Kasih star jika proyek ini membantumu!</strong>
</div>
