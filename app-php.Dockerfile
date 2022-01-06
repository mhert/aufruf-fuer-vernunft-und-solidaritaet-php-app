FROM php:8.1.1-fpm-bullseye as app-php-builder

RUN mkdir -p /var/wwww
WORKDIR /var/www

RUN apt update && \
    apt install -y git libpq-dev libzip-dev libzstd-dev zlib1g-dev unzip p7zip && \
    docker-php-ext-install -j$(nproc) pdo pdo_pgsql zip && \
    docker-php-ext-enable pdo pdo_pgsql zip

COPY docker/app-php/install-composer /usr/local/bin/
RUN install-composer

COPY bin /var/www/bin
COPY config /var/www/config
COPY public /var/www/public
COPY src /var/www/src
COPY templates /var/www/templates
COPY composer.json /var/www/composer.json
COPY composer.lock /var/www/composer.lock
COPY symfony.lock /var/www/symfony.lock

RUN composer install --no-dev

RUN bin/console cache:clear --env=prod


FROM app-php-builder as app-php-dev

RUN mkdir -p /var/wwww
WORKDIR /var/www

RUN apt update && \
    apt install -y gpg wget

COPY docker/app-php/install-phive /usr/local/bin/
RUN install-phive

RUN apt update && \
    apt install -y 	libxml2-utils yamllint


FROM php:8.1-fpm-buster as app-php-prod
RUN apt update && \
    apt install -y libpq-dev && \
    docker-php-ext-install -j$(nproc) pdo pdo_pgsql && \
    docker-php-ext-enable pdo pdo_pgsql

RUN mkdir -p /var/www
WORKDIR /var/www

COPY --from=app-php-builder /var/www/config /var/www/config
COPY --from=app-php-builder /var/www/public /var/www/public
COPY --from=app-php-builder /var/www/src /var/www/src
COPY --from=app-php-builder /var/www/templates /var/www/templates
COPY --from=app-php-builder /var/www/var /var/www/var
COPY --from=app-php-builder /var/www/vendor /var/www/vendor
