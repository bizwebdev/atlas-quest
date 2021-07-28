FROM php:7.2-apache
ADD . /var/www/html
WORKDIR /var/www/html
EXPOSE 80