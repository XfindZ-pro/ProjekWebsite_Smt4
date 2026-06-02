FROM serversideup/php:8.4-fpm-nginx

USER root
WORKDIR /var/www/html

COPY --chown=www-data:www-data . .

# Install dependency aja, jangan cache config dulu
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Set permission
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

USER www-data