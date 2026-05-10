# 1. Sử dụng PHP 8.3 Apache
FROM php:8.3-apache

# 2. Cài đặt công cụ hỗ trợ cài extension nhanh
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

# 3. Cài các extension cần thiết (Bao gồm driver PostgreSQL)
RUN install-php-extensions pdo_mysql pdo_pgsql pgsql gd zip intl bcmath

# 4. CÀI ĐẶT NODE.JS (Để chạy npm build)
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# 5. Kích hoạt mod_rewrite cho Laravel
RUN a2enmod rewrite

# 6. Cấu hình thư mục Public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 7. Thiết lập thư mục làm việc
WORKDIR /var/www/html

# 8. Copy toàn bộ code vào container
COPY . .

# 9. Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 10. BIÊN DỊCH ASSETS (Fix lỗi Vite Manifest)
RUN npm install && npm run build

# 11. Cấp quyền cho thư mục storage và cache
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]