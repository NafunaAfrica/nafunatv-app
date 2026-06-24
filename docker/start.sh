#!/bin/sh

# Cache Laravel configurations for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations (creates database.sqlite as root)
php artisan migrate --force

# Seed the database automatically if it is empty
php artisan tinker --execute="if(App\Models\Category::count() === 0) { Artisan::call('db:seed', ['--force' => true]); echo 'Database seeded!'; }"

# Fix permissions AFTER the database file and cache files are created
chown -R www-data:www-data /app/database /app/storage /app/bootstrap/cache
chmod -R 775 /app/database /app/storage /app/bootstrap/cache

# Start PHP-FPM in the background
php-fpm -D

# Start Nginx in the foreground to keep the container running
nginx -g "daemon off;"
