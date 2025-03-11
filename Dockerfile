# Use the official PHP 8.3 FPM Alpine image
FROM php:8.3-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
    bash git curl zip unzip \
    mariadb-client redis sqlite \
    libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev \
    postgresql-dev nodejs yarn nginx supervisor

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        curl dom fileinfo mbstring iconv openssl \
        pdo pdo_mysql pdo_sqlite pdo_pgsql redis tokenizer zip \
    && docker-php-ext-enable opcache

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Laravel project files
COPY . .

# Set permissions for Laravel storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install dependencies and optimize
RUN composer install --no-dev --optimize-autoloader \
    && php artisan cache:clear && php artisan config:clear \
    && php artisan route:cache && php artisan view:cache

# Expose Fly.io default port
EXPOSE 8080

# Start PHP-FPM
CMD ["php-fpm", "-F"]

