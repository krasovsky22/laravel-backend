FROM php:7.4-fpm

COPY composer.lock composer.json /var/www/

WORKDIR /var/www

COPY database database

RUN apt-get update && apt-get -y install git && apt-get -y install zip

RUN  apt-get install -y libmcrypt-dev \
    libmagickwand-dev --no-install-recommends \
    && pecl install mcrypt-1.0.3 \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable mcrypt

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === 'baf1608c33254d00611ac1705c1d9958c817a1a33bce370c0595974b342601bd80b92a3f46067da89e3b06bff421f182') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && php composer.phar install --no-dev --no-scripts \
    && rm composer.phar

COPY . .

RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache

COPY .env.docker .env

RUN php artisan optimize
