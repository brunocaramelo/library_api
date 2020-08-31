FROM php:7.2-fpm

# Install PHP extensions
RUN apt-get update && apt-get install -y \
      zlib1g-dev \
      sqlite3 \
      libsqlite3-dev \
      libicu-dev \
      libpq-dev \
      libmcrypt-dev \
    && rm -r /var/lib/apt/lists/* \
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
      
# RUN yes | pecl install xdebug 

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

COPY ./application/ /app

# install phpunit
RUN curl -fsSL https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && composer global require phpunit/phpunit ^7.5 --no-progress --no-scripts --no-interaction

# install cron
RUN apt-get update && apt-get -y install rsyslog

# Change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

WORKDIR /app

RUN chown -R www-data:www-data /app

ENV PATH /root/.composer/vendor/bin:$PATH
CMD ["php-fpm"]