# Dependencias PHP (PHPMailer) con Composer
FROM composer:2 AS vendor
WORKDIR /app/extensiones
COPY extensiones/composer.json extensiones/composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist

# Aplicación: PHP 8.2 + Apache con mod_rewrite (rutas amigables del .htaccess)
FROM php:8.2-apache

# Configuración de producción: los avisos de PHP van al log, no a la página
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN apt-get update \
 && apt-get install -y --no-install-recommends libpng-dev libjpeg62-turbo-dev \
 && docker-php-ext-configure gd --with-jpeg \
 && docker-php-ext-install pdo_mysql gd \
 && a2enmod rewrite \
 && sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf \
 && rm -rf /var/lib/apt/lists/*

COPY . /var/www/html/
COPY --from=vendor /app/extensiones/vendor /var/www/html/extensiones/vendor

# Carpetas donde la aplicación guarda las imágenes subidas
RUN chown -R www-data:www-data /var/www/html/backend/vistas/img /var/www/html/vistas/img
