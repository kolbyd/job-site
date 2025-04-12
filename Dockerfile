# Stage 1: Get composer dependencies
FROM composer:2.8 AS composer-deps
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-scripts

# Stage 2: Build node dependencies
FROM node:20 AS node-build
WORKDIR /app
COPY package.json package-lock.json vite.config.js ./
COPY resources/js ./resources/js
COPY resources/css ./resources/css

RUN npm ci
RUN npm run build

# Stage 3: Build the final image
FROM php:8.2-fpm-alpine AS final

# Install system dependencies
RUN apk add --no-cache \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    freetype-dev \
    libxml2-dev \
    oniguruma-dev \
    unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

WORKDIR /var/www
COPY --from=composer-deps /app/vendor ./vendor
COPY --from=node-build /app/public/build ./public/build
COPY ./ ./

RUN chown -R www-data:www-data /var/www && \
    find /var/www -type f -exec chmod 644 {} \; && \
    find /var/www -type d -exec chmod 755 {} \;

RUN chgrp -R www-data storage bootstrap/cache && \
    chmod -R ug+rwx storage bootstrap/cache

EXPOSE 9000

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
