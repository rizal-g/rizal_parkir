FROM php:8.2-cli

# Install extension bawaan yang wajib buat Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git \
    && docker-php-ext-install zip pdo_mysql

# Install Composer langsung dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Jalankan composer install saat build image
RUN composer install --no-interaction --optimize-autoloader

# Jalankan perintah serve sebagai default command container
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
