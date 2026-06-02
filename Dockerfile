FROM serversideup/php:8.4-fpm-nginx

USER root
WORKDIR /var/www/html

# Copy semua file ke container
COPY --chown=www-data:www-data . .

# Install dependency
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Set permission Laravel
RUN php artisan storage:link || true
RUN php artisan config:cache
RUN php artisan route:cache  
RUN php artisan view:cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

USER www-data