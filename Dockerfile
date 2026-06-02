FROM serversideup/php:8.4-frankenphp

USER root

# Install extension MySQL
RUN install-php-extensions pdo_mysql

ENV PHP_OPCACHE_ENABLE=1
ENV APP_BASE_DIR=/var/www/html
ENV CADDY_SERVER_ROOT=/var/www/html/public

WORKDIR /var/www/html
COPY --chown=www-data:www-data . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

USER www-data