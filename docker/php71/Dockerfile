FROM php:7.1-fpm

WORKDIR /var/www

COPY ./php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y \
    curl \
    wget \
    git \
    unzip \
    libicu-dev

# PHP拡張のインストール
RUN docker-php-ext-install \
    intl \
    mbstring

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Composerのインストール
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer
