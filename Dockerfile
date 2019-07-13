FROM php:7.0-apache
COPY ./ /var/www
RUN apt-get update \
 && apt-get install -y git zlib1g-dev \
 && docker-php-ext-install zip \
 && a2enmod rewrite \
 && chmod -R 777 /var/www \
 && chown www-data:www-data /var/www/ \
 && chown root:root /var/www/ \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer 

WORKDIR /var/www
EXPOSE 8080