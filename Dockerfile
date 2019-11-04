FROM php:7.2-fpm
MAINTAINER smallThinking <wnsdnek778@gmail.com>

WORKDIR /root

RUN apt-get update
RUN apt-get install -y curl

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/bin/composer

RUN apt-get install -y zlib1g-dev && apt-get install -y libzip-dev
RUN docker-php-ext-install zip

EXPOSE 8000
CMD ["php-fpm"]