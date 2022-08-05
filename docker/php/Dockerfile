FROM php:8.0-fpm-buster
SHELL ["/bin/bash","-oeux","pipefail","-c"]

# RUN docker-php-ext-install pdo_mysql && \
#     docker-php-ext-enable mysqli
RUN docker-php-ext-install mysqli && \
    docker-php-ext-enable mysqli
COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www
