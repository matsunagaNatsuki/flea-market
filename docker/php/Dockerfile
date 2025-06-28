FROM php:7.4.9-fpm

COPY php.ini /usr/local/etc/php/

RUN apt update \
    &amp;&amp; apt install -y default-mysql-client zlib1g-dev libzip-dev unzip \
    &amp;&amp; docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php \
    &amp;&amp; mv composer.phar /usr/local/bin/composer \
    &amp;&amp; composer self-update

WORKDIR /var/www
