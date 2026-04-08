# Gunakan image PHP versi 8.2 yang sudah dilengkapi server Apache
FROM php:8.2-apache

# FIX ERROR MPM: Matikan modul event/worker yang bentrok dan pastikan prefork menyala
RUN a2dismod mpm_event mpm_worker || true
RUN a2enmod mpm_prefork

# Aktifkan mod_rewrite Apache agar file .htaccess di folder public bisa dibaca
RUN a2enmod rewrite

# Install ekstensi PDO dan MySQL agar aplikasi bisa terhubung ke database
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Salin semua file dari komputer ke dalam folder server Docker
COPY . /var/www/html/

# Ubah settingan Apache agar langsung mengarah ke folder /public (DocumentRoot)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Berikan hak akses pada folder agar tidak terjadi error permission
RUN chown -R www-data:www-data /var/www/html

# Ekspos port 80 (Port standar website Apache)
EXPOSE 80