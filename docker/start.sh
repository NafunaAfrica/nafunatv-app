#!/bin/sh

# Cache Laravel configurations for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions for storage cache (essential for Laravel)
chown -R www-data:www-data /app/storage /app/bootstrap/cache
chmod -R 775 /app/storage /app/bootstrap/cache

# Start PHP-FPM in the background
php-fpm -D

# Start Nginx in the foreground to keep the container running
nginx -g "daemon off;"
