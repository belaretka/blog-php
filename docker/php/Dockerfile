FROM php:8.1-fpm

RUN apt-get update
RUN apt-get install -y curl git
RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer |php
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/public_html

ENTRYPOINT [ "php-fpm" ]