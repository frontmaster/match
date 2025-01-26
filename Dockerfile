FROM php:8.1-fpm

# 必要な拡張モジュールをインストール
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    zip \
    curl && \
    docker-php-ext-install pdo_mysql mbstring zip

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html