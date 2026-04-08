# 1. Gunakan image PHP versi 8.2 Apache
FROM php:8.2-apache

# 2. FIX ERROR MPM: Hapus paksa semua shortcut MPM yang ada, lalu nyalakan HANYA prefork
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load && a2enmod mpm_prefork

# 3. Aktifkan mod_rewrite Apache agar file .htaccess di folder public bisa dibaca
RUN a2enmod rewrite

# 4. Install ekstensi database PDO dan MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# 5. Salin semua file dari komputer ke dalam folder server Docker
COPY . /var/www/html/

# 6. Atur Document Root ke folder /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 7. FIX RAILWAY PORT: Ubah settingan Apache agar mendengarkan $PORT dinamis dari Railway (Bukan port 80 statis)
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# 8. Beri hak akses pada folder agar tidak terjadi error permission
RUN chown -R www-data:www-data /var/www/html