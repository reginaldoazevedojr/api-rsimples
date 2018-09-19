FROM php:7.2-fpm

MAINTAINER reginaldoazevedojr@gmail.com

LABEL Description="Webserver RSimples"

WORKDIR /app

RUN pecl install xdebug-2.6.0 \
    && docker-php-ext-enable xdebug
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql
#RUN echo 'zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20170718/xdebug.so' >> /usr/local/etc/php/php.ini
#RUN echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/php.ini
#RUN echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini
#RUN echo 'xdebug.remote_connect_back=1' >> /usr/local/etc/php/php.ini
#RUN echo 'xdebug.idekey = PHPSTORM' >> /usr/local/etc/php/php.ini
#RUN echo 'xdebug.show_error_trace=1' >> /usr/local/etc/php/php.ini
#RUN echo 'xdebug.remote_autostart=0' >> /usr/local/etc/php/php.ini
#RUN echo 'xdebug.remote_host=192.168.15.33' >> /usr/local/etc/php/php.ini
