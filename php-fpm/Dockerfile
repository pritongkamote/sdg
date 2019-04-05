# php-fpm
FROM php:fpm-alpine

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli

CMD ["php-fpm"]

EXPOSE 9000
