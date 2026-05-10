# 1. Đổi từ 8.2 thành 8.3 ở đây
FROM php:8.3-apache

# 2. Cài đặt công cụ hỗ trợ cài extension nhanh
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

# 3. Cài các extension cần thiết (Đã thêm driver PostgreSQL)
RUN install-php-extensions pdo_mysql pdo_pgsql pgsql gd zip intl bcmath

# 4. Kích hoạt mod_rewrite cho Laravel
RUN a2enmod rewrite

# 5. Cấu hình thư mục Public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 6. Copy code và cài Composer
WORKDIR /var/www/html
COPY . .
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 7. Cấp quyền cho thư mục
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]