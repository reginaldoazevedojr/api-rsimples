FROM php:7.2-fpm

MAINTAINER reginaldoazevedojr@gmail.com

LABEL Description="Webserver RSimples"

RUN pecl install xdebug-2.6.0 \
    && docker-php-ext-enable xdebug
