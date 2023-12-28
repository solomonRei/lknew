# Используйте официальный образ PHP с предустановленным Apache
FROM php:8.0-apache

# Установите расширения PHP, необходимые для Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Включите модуль Apache Rewrite
RUN a2enmod rewrite

# Копируйте исходный код приложения в контейнер
COPY . /var/www/html

# Установите зависимости Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Установите права доступа
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache
