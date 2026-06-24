FROM php:8.3-fpm-alpine

# Install SQLite, Nginx, and required packages
RUN apk add --no-cache nginx sqlite-dev libzip-dev zip unzip curl

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo pdo_sqlite zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions for Laravel
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache
RUN chmod -R 775 /app/storage /app/bootstrap/cache

# Copy Nginx configuration
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Copy Start script
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

# Expose port 80 for Nginx
EXPOSE 80

# Start application
CMD ["/start.sh"]
