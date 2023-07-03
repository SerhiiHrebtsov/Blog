FROM php:8.1.0-fpm-alpine

# Install packages
RUN apk add --no-cache curl git build-base zlib-dev oniguruma-dev autoconf bash
RUN apk add --update linux-headers

# Xdebug
ARG INSTALL_XDEBUG=false

RUN if [ ${INSTALL_XDEBUG} = true ]; \
    then \
      pecl install xdebug && docker-php-ext-enable xdebug; \
    fi;
COPY ./docker/php-fpm/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Configure non-root user.
ARG PUID=1000
ARG PGID=1000
RUN apk --no-cache add shadow && \
    groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

# Source code
RUN chown www-data:www-data /var/www
COPY --chown=www-data:www-data ./ /var/www
WORKDIR /var/www

# Mysql
RUN apk add --no-cache libpq-dev && docker-php-ext-install pdo_mysql mysqli

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.5.1
#RUN chown -R www-data:www-data /var/www/vendor/

## Node.js
#RUN curl -sL https://deb.nodesource.com/setup_16.x -o nodesource_setup.sh
#RUN bash nodesource_setup.sh
#RUN apk add nodejs
#RUN npm install npm@8.1.0 -g
RUN apk add --update nodejs npm
RUN command -v node
RUN command -v npm

CMD php-fpm

EXPOSE 9000