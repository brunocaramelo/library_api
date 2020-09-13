FROM composer:1.9.0 as builder

COPY ./application/ /app

RUN composer install  \
    --ignore-platform-reqs \
    --no-ansi \
    --no-autoloader \
    --no-interaction \
    --no-scripts \
    --prefer-dist

RUN composer dump-autoload --optimize --classmap-authoritative

FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
      zlib1g-dev \
      sqlite3 \
      libsqlite3-dev \
      libicu-dev \
      libpq-dev \
      libmcrypt-dev \
      libzip-dev \
    && rm -r /var/lib/apt/lists/* \
    && docker-php-ext-install exif \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-install \
      intl \
      mbstring \
      pcntl \
      pdo_mysql \
      pdo_pgsql \
      pdo_sqlite \
      pgsql \
      zip \
      opcache

COPY --from=builder /app /app

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

WORKDIR /app

RUN sed -e '/^access.log =/s/^/;/' -i /usr/local/etc/php-fpm.d/docker.conf

RUN chown -R www-data:www-data /app

CMD ["php-fpm"]