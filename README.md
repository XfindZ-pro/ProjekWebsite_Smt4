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

**Valora** adalah platform marketplace inovatif yang dirancang khusus untuk memfasilitasi transaksi **sisa produksi (industrial waste)** dan **bahan baku industri**. Aplikasi ini menghubungkan pemilik pabrik atau usaha yang memiliki limbah produksi layak pakai dengan pelaku industri lain yang membutuhkan bahan baku dengan harga lebih ekonomis.

Tujuan utama Valora adalah mendukung ekonomi sirkular dengan mengurangi limbah industri sekaligus menciptakan peluang ekonomi baru melalui pengelolaan sisa produksi yang lebih terorganisir.

---

## ✨ Fitur Unggulan

Aplikasi ini dibangun dengan fokus pada keamanan dan kemudahan penggunaan:

### 👤 Manajemen Pengguna & Keamanan
- **Sistem Autentikasi**: Login dan Register yang aman.
- **Reset Password via OTP**: Keamanan ekstra menggunakan kode OTP yang dikirim langsung ke email pengguna menggunakan **PHPMailer**.
- **Profil Dinamis**: Pengguna dapat mengelola foto profil, foto banner, dan informasi identitas mereka.

### 🏭 Verifikasi Bisnis (KYB)
- **Sistem Pengajuan Verifikasi**: Penjual wajib mengunggah dokumen KTP dan Izin Usaha untuk menjamin validitas bisnis.
- **Validasi Admin**: Admin memiliki otoritas penuh untuk menyetujui atau menolak pengajuan verifikasi berdasarkan dokumen yang dikirim.

### 📦 Manajemen Katalog Produk
- **Dashboard Penjual**: Kelola sisa produksi Anda (Tambah, Edit, Hapus) dengan dukungan hingga 3 foto produk dan dokumen pendukung.
- **Smart Catalog**: Fitur pencarian produk berdasarkan kata kunci, filter kategori limbah, lokasi pickup, dan pengurutan harga.

### 📊 Admin Control Center
- **Statistik Real-time**: Monitor total pengguna, produk aktif, dan antrean verifikasi.
- **Manajemen User**: Pantau seluruh basis pengguna platform dalam satu tampilan.

---

## 🛠️ Tech Stack

Dibuat dengan teknologi modern dan struktur yang terorganisir:

- **Language**: PHP 8.x (Native)
- **Database**: MySQL (PDO Connection untuk keamanan dari SQL Injection)
- **Pattern**: **MVC (Model-View-Controller)** - Arsitektur terpisah untuk logika, data, dan tampilan.
- **Dependency Manager**: **Composer** (Digunakan untuk Autoloading dan Manajemen Library).
- **Email Service**: **PHPMailer** (Terintegrasi dengan SMTP Gmail untuk pengiriman OTP).
- **Frontend**: Vanilla HTML5, CSS3 (Modern UI), dan JavaScript.

---

## 🗂️ Struktur Folder (Clean Architecture)

```
Valora/
├── app/
│   ├── Controllers/    # Logika alur aplikasi
│   ├── Core/           # Inti framework (Router & Base Class)
│   ├── Models/         # Manajemen data (Akun, Produk, OTP, Verifikasi)
│   └── init.php        # Inisialisasi aplikasi
├── config/             # Konfigurasi Database & SMTP
├── public/             # Entry point & Assets (CSS, JS, Images)
├── vendor/             # Library pihak ketiga (Composer)
└── views/              # Template tampilan (UI)
```

---

## 🚀 Cara Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/XfindZ-pro/ProjekWebsite_Smt4.git
   ```

2. **Install Dependencies**
   Pastikan Anda sudah menginstal Composer, lalu jalankan:
   ```bash
   composer install
   ```

3. **Konfigurasi Database**
   Sesuaikan pengaturan di `config/config.php` dengan database lokal Anda.

4. **Aktifkan SMTP (Optional untuk OTP)**
   Dapatkan **App Password** dari Google Account Anda dan masukkan ke `config/config.php`.

---

<div align="center">
  <p>Dibuat untuk Tugas Proyek Semester 4 - Pemrograman Web</p>
  <strong>⭐ Kasih star jika proyek ini membantumu!</strong>
</div>
