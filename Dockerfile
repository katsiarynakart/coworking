FROM php:8.4-fpm-alpine

# DB
RUN apk add --no-cache bash git icu-dev libpq-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl pdo pdo_mysql

# composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# work directory
WORKDIR /var/www/project

# web-servers port
EXPOSE 9000

CMD ["php-fpm"]
