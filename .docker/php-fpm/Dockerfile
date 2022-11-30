FROM php:8.1-fpm

RUN apt-get update && apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev librabbitmq-dev supervisor \
    && pecl install amqp \
    && docker-php-ext-configure zip \
    && docker-php-ext-install opcache pdo pdo_mysql zip \
    && docker-php-ext-enable amqp

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
