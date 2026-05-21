# Quick Start - Valora Laravel

## 🚀 Mulai Cepat (3 Langkah)

### 1️⃣ Install Dependencies
```bash
composer install
```

### 2️⃣ Setup Environment
```bash
# Copy environment config
cp .env.example .env

# Generate application key
php artisan key:generate
```

**Edit `.env`** jika diperlukan (biasanya database credentials sudah ada):
```ini
DB_HOST=sq-7tm.h.filess.io
DB_PORT=61002
DB_DATABASE=pemweb_properlyby
DB_USERNAME=pemweb_properlyby
DB_PASSWORD=94da42107be4051036514940cf31d63f1b52dc13
```

### 3️⃣ Jalankan Server
```bash
php artisan serve
```

Buka browser: **http://localhost:8000** ✨

---

## 📌 Informasi Penting

### Views Location
- Views tetap di folder `views/` (bukan `resources/views`)
- Contoh: `views/home/index.php` dipanggil dengan `view('home.index')`

### Database
- Sudah dikonfigurasi di `.env`
- Pastikan database server berjalan
- Models di `app/Models/` (kompatibel dengan kode lama)

### Storage Permissions
Jika ada error permission di folder storage:
```bash
chmod -R 775 storage/
```

### Clear Cache (jika ada error)
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

---

## 🔗 Penting untuk Dibaca
- [KONVERSI_GUIDE.md](KONVERSI_GUIDE.md) - Dokumentasi lengkap konversi
- [LARAVEL_README.md](LARAVEL_README.md) - Struktur project lengkap

---

**Siap!** 🎉 Aplikasi Anda sudah Laravel-ready!
