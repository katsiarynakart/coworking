FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
        bash \
        git \
        icu-dev \
        libpq-dev \
        linux-headers \
        $PHPIZE_DEPS \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl pdo pdo_mysql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY docker/php/conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# work directory
WORKDIR /var/www/project

# web-servers port
EXPOSE 9000

CMD ["php-fpm"]
