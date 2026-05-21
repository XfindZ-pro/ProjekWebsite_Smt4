# Valora - Konversi Laravel

Proyek ini adalah konversi dari PHP Native MVC menjadi Laravel Framework.

## Struktur Proyek

```
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Laravel Controllers
│   │   ├── Middleware/       # Custom Middleware
│   │   └── Kernel.php        # HTTP Kernel
│   ├── Console/
│   │   └── Kernel.php        # Console Kernel
│   ├── Exceptions/
│   │   └── Handler.php       # Exception Handler
│   ├── Models/              # Models (kompatibel dengan kode lama)
│   ├── Core/                # Core files lama (tetap ada untuk kompatibilitas)
│   ├── Controllers/         # Controllers lama (tetap ada untuk referensi)
│   └── Providers/           # Service Providers
├── bootstrap/
│   └── app.php             # Laravel Application Bootstrap
├── config/
│   ├── app.php
│   ├── database.php
│   ├── view.php
│   ├── mail.php
│   ├── session.php
│   └── cache.php
├── routes/
│   ├── web.php             # Web Routes (menggantikan router.php lama)
│   └── console.php
├── views/                  # Views (struktur tetap sama)
├── public/
│   ├── index.php           # Updated Entry Point
│   └── ...
├── storage/
│   ├── logs/
│   └── framework/
├── database/
│   ├── migrations/
│   └── seeders/
├── .env                    # Environment Configuration
├── .env.example            # Environment Template
├── artisan                 # Artisan Console
└── composer.json           # Dependencies
```

## Instalasi

1. **Install Dependencies**
   ```bash
   composer install
   ```

2. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

3. **Configure Environment**
   - Copy `.env.example` ke `.env`
   - Update database credentials dan SMTP settings

4. **Run Development Server**
   ```bash
   php artisan serve
   ```
   atau
   ```bash
   php -S localhost:8000 -t public
   ```

## Perbedaan dengan PHP Native

- **Routing**: Menggunakan `routes/web.php` (Laravel) alih-alih `router.php`
- **Controllers**: Menggunakan namespace dan struktur Laravel
- **Views**: Tetap berada di folder `views/`, bukan `resources/views`
- **Database**: Tetap menggunakan PDO dengan class `Database` lama
- **Models**: Kompatibel dengan kode lama, dapat diperbaiki ke Eloquent nanti

## Kompatibilitas Kode Lama

- Base `Controller` di `app/Http/Controllers/Controller.php` memiliki method `view()` dan `model()` yang kompatibel dengan kode lama
- Models dapat tetap menggunakan PDO queries lama
- Session management tetap sama dengan PHP native

## Development

Untuk menjalankan dalam mode development dengan auto-reload:

```bash
php artisan serve
```

Untuk cache clearing:
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

## Notes

- Pastikan folder `storage/` dapat ditulis oleh web server
- Setup MAIL_* di `.env` untuk fitur email
- Database harus sudah dibuat sebelumnya (migrasi belum diimplementasikan)
