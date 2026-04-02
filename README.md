<div align="center">

<!-- Animated Banner -->
<img src="https://capsule-render.vercel.app/api?type=waving&color=gradient&customColorList=6,11,20&height=200&section=header&text=Website%20Valora&fontSize=60&fontColor=ffffff&animation=fadeIn&fontAlignY=38&desc=Proyek%20Website%20Semester%204&descAlignY=60&descAlign=50" width="100%"/>

<!-- Badges -->
<p>
  <img src="https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white"/>
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white"/>
  <img src="https://img.shields.io/badge/Status-Active-brightgreen?style=for-the-badge"/>
  <img src="https://img.shields.io/badge/Semester-4-orange?style=for-the-badge"/>
  <img src="https://img.shields.io/github/last-commit/XfindZ-pro/ProjekWebsite_Smt4?style=for-the-badge&color=blue"/>
</p>

<!-- Action Buttons -->
<p>
  <a href="https://github.com/XfindZ-pro/ProjekWebsite_Smt4/archive/refs/heads/main.zip">
    <img src="https://img.shields.io/badge/⬇️%20Download%20ZIP-2ea44f?style=for-the-badge"/>
  </a>
  <a href="https://github.com/XfindZ-pro/ProjekWebsite_Smt4/issues/new">
    <img src="https://img.shields.io/badge/🐛%20Laporkan%20Bug-red?style=for-the-badge"/>
  </a>
  <a href="https://github.com/XfindZ-pro/ProjekWebsite_Smt4/fork">
    <img src="https://img.shields.io/badge/🍴%20Fork%20Repo-blueviolet?style=for-the-badge"/>
  </a>
</p>

</div>

---

## 📖 Tentang Proyek

**Website Valora** adalah proyek website sederhana yang dikembangkan sebagai tugas Proyek Semester 4. Website ini dibangun menggunakan **PHP** dan **MySQL** sebagai backend, dengan arsitektur yang terstruktur melalui pembagian folder `app`, `config`, `public`, dan `views`.

> 💡 Proyek ini merupakan implementasi nyata dari konsep pengembangan web dinamis menggunakan teknologi server-side scripting.

---

## ✨ Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| 🗄️ **Database MySQL** | Penyimpanan data menggunakan MySQL yang efisien |
| 🧩 **Arsitektur MVC** | Struktur kode terorganisir dengan folder `app`, `views`, `config` |
| 🌐 **Dynamic Pages** | Halaman web dinamis dirender oleh PHP |
| ⚙️ **Config Management** | Konfigurasi database terpusat di folder `config` |
| 🎨 **Public Assets** | Aset statis (CSS, JS, gambar) dikelola di folder `public` |

---

## 🗂️ Struktur Proyek

```
ProjekWebsite_Smt4/
│
├── 📁 app/          # Logika aplikasi (controller, model)
├── 📁 config/       # Konfigurasi database & environment
├── 📁 public/       # Aset publik (CSS, JavaScript, gambar)
├── 📁 views/        # Template / halaman tampilan HTML
└── 📄 .gitignore    # File yang dikecualikan dari versi kontrol
```

---

## 🛠️ Teknologi yang Digunakan

<p>
  <img src="https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white" height="28"/>
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white" height="28"/>
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white" height="28"/>
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white" height="28"/>
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black" height="28"/>
</p>

---

## 🚀 Cara Menjalankan

### Prasyarat

Pastikan kamu sudah menginstal:

- [XAMPP](https://www.apachefriends.org/) / [Laragon](https://laragon.org/) / web server PHP lokal
- PHP versi **7.4+**
- MySQL / MariaDB

### Langkah Instalasi

**1. Clone repositori ini**
```bash
git clone https://github.com/XfindZ-pro/ProjekWebsite_Smt4.git
```

**2. Pindahkan ke folder htdocs**
```bash
# Untuk XAMPP (Windows)
mv ProjekWebsite_Smt4 C:/xampp/htdocs/

# Untuk XAMPP (Linux/Mac)
mv ProjekWebsite_Smt4 /opt/lampp/htdocs/
```

**3. Buat database MySQL**
```sql
CREATE DATABASE valora_db;
```

**4. Konfigurasi koneksi database**

Buka file di `config/` dan sesuaikan pengaturan berikut:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'valora_db');
```

**5. Jalankan aplikasi**

Buka browser dan akses:
```
http://localhost/ProjekWebsite_Smt4/public/
```

---

## 📸 Screenshot

> *Tambahkan screenshot tampilan website di sini*

```
screenshots/
├── halaman-utama.png
├── halaman-login.png
└── dashboard.png
```

---

## 👨‍💻 Kontributor

<a href="https://github.com/XfindZ-pro">
  <img src="https://github.com/XfindZ-pro.png" width="64" style="border-radius:50%"/>
</a>

**XfindZ-pro** — Developer Utama

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan **akademik** — Tugas Proyek Semester 4.

---

<div align="center">

<img src="https://capsule-render.vercel.app/api?type=waving&color=gradient&customColorList=6,11,20&height=100&section=footer" width="100%"/>

<p>
  <img src="https://komarev.com/ghpvc/?username=XfindZ-pro&label=Profile%20Views&color=blueviolet&style=flat-square"/>
</p>

**⭐ Jangan lupa kasih star kalau proyek ini membantu!**

</div>
