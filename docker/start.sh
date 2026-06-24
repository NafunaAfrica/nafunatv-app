#!/bin/sh

# Cache Laravel configurations for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Fix permissions for persistent SQLite volume so www-data can write to it
chown -R www-data:www-data /app/database
chmod -R 775 /app/database

# Run database migrations
php artisan migrate --force

# Seed the database automatically if it is empty
php artisan tinker --execute="if(App\Models\Category::count() === 0) { Artisan::call('db:seed', ['--force' => true]); echo 'Database seeded!'; }"

# Start PHP-FPM in the background
php-fpm -D

# Start Nginx in the foreground to keep the container running
nginx -g "daemon off;"
