# 1. Gunakan PHP CLI yang sangat ringan dan bebas dari error Apache MPM
FROM php:8.2-cli

# 2. Install ekstensi database agar fitur Login/Register kamu tidak error
RUN docker-php-ext-install pdo pdo_mysql mysqli

# 3. Pindahkan file aplikasi ke dalam container
COPY . /app
WORKDIR /app

# 4. Jalankan PHP Built-in Server. 
# Catatan: Kita arahkan server ke public/router.php untuk menggantikan .htaccess
# Kita juga menggunakan variabel $PORT dari Railway.
CMD php -S 0.0.0.0:$PORT -t public public/router.php