# Sử dụng image PHP chính thức với Apache
FROM php:8.2-apache

# Cài đặt các phần mở rộng PHP cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Kích hoạt mod_rewrite của Apache (quan trọng cho Laravel)
RUN a2enmod rewrite

# Cấu hình lại thư mục gốc của Apache trỏ vào thư mục public của Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Copy toàn bộ code vào container
WORKDIR /var/www/html
COPY . .

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Cấp quyền cho các thư mục storage và bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Port mặc định của Apache
EXPOSE 80

# Chạy lệnh khởi động
CMD ["apache2-foreground"]