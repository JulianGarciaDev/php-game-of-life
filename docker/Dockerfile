FROM php:7.4-apache

# Apache config
COPY apache/game-of-life.conf /etc/apache2/sites-available/000-default.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Git
RUN apt-get update && apt-get install -y git