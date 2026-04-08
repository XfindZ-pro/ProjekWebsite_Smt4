FROM php:8.2-apache

# Copy SEMUA folder ke dalam container
COPY . /var/www/html/

# Set document root ke folder public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

EXPOSE 80
