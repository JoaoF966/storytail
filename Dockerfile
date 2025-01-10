FROM php:8.2-fpm-alpine

RUN apk update \
    && apk add --update nodejs npm


RUN apk add --update linux-headers \
    && apk add --no-cache curl bash $PHPIZE_DEPS

RUN docker-php-ext-install pdo pdo_mysql

RUN apk add --no-cache \
        libjpeg-turbo-dev \
        libpng-dev \
        libwebp-dev \
        freetype-dev

# As of PHP 7.4 we don't need to add --with-png
RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype
RUN docker-php-ext-install gd

# Install imagick dependencies and imagick itself
RUN apk add --no-cache \
        ghostscript \
        imagemagick-dev \
        imagemagick \
        && pecl install imagick \
        && docker-php-ext-enable imagick

RUN apk add --no-cache \
        libzip-dev \
        zip \
  && docker-php-ext-install zip

RUN apk add icu-dev
RUN docker-php-ext-configure intl && docker-php-ext-install intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug-3.3.1 && docker-php-ext-enable xdebug
RUN echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.log=/var/www/html/xdebug/xdebug.log" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini

# Set PHP configuration for upload_max_filesize and post_max_size
RUN echo "upload_max_filesize=20M" >> /usr/local/etc/php/php.ini \
    && echo "post_max_size=21M" >> /usr/local/etc/php/php.ini

WORKDIR /var/www/html

# Create a group and user
RUN addgroup -S appgroup && adduser -S appuser -G appgroup --uid 1000

RUN chown -R appuser:www-data .

# Tell docker that all future commands should run as the appuser user
USER appuser

EXPOSE 9000

CMD ["php-fpm"]

