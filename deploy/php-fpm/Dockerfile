FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
        zip \
        libzip-dev \
        unzip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY app.ini $PHP_INI_DIR/conf.d/app.ini
COPY entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh
RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

ENTRYPOINT ["/entrypoint.sh"]

WORKDIR /app

CMD ["php-fpm"]