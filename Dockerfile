# Gunakan image PHP dengan Apache dan ekstensi yang dibutuhkan Laravel
FROM php:8.3-apache

# Install dependensi sistem dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libonig-dev libxml2-dev zip sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring

# Aktifkan mod_rewrite untuk Laravel
RUN a2enmod rewrite

# Salin file Laravel ke direktori kerja Apache
COPY . /var/www/html

# Set direktori kerja
WORKDIR /var/www/html

# Ubah permission agar Laravel bisa menulis di storage dan bootstrap/cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Jalankan composer install
RUN composer install --no-dev --optimize-autoloader

# Set environment production
ENV APP_ENV=production
ENV APP_DEBUG=false

# Port untuk Apache
EXPOSE 80
