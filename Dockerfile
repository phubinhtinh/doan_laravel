FROM php:8.2-apache

# 1. Cài đặt các công cụ hỗ trợ cài extension nhanh và nhẹ hơn
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

# 2. Cài các extension cần thiết (Bỏ pdo vì đã có sẵn, chỉ cài pdo_mysql và gd)
RUN install-php-extensions pdo_mysql gd zip intl bcmath

# 3. Kích hoạt mod_rewrite cho Laravel
RUN a2enmod rewrite

# 4. Cấu hình thư mục Public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 5. Copy code và cài Composer
WORKDIR /var/www/html
COPY . .
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 6. Cấp quyền
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]