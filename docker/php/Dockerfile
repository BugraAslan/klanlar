FROM php:7.4-fpm

RUN apt-get update -y && apt-get install -y \
    apt-utils \
    git \
    unzip \
    nano \
    libsasl2-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    libicu-dev \
    libxrender1 \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libfontconfig1 \
    libc6 \
    libgcc1 \
    libsodium-dev \
    libbz2-dev \
    libpq-dev \
    libmagick++-dev \
    libmagickwand-dev \
    && docker-php-ext-configure gd \
    && docker-php-ext-install bz2 \
    && docker-php-ext-install opcache \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install sodium

#RUN version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
#    && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/linux/amd64/$version \
#    && mkdir -p /tmp/blackfire \
#    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp/blackfire \
#    && mv /tmp/blackfire/blackfire-*.so $(php -r "echo ini_get ('extension_dir');")/blackfire.so \
#    && printf "extension=blackfire.so\nblackfire.agent_socket=tcp://0.0.0.0:8307\n" > $PHP_INI_DIR/conf.d/docker-php-ext-blackfire.ini \
#    && rm -rf /tmp/blackfire /tmp/blackfire-probe.tar.gz

RUN pecl update-channels \
    && pecl install apcu-5.1.17	\
    && echo "extension=apcu.so" >> /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini

RUN pecl install imagick
RUN echo "extension=imagick.so" >> /usr/local/etc/php/conf.d/docker-php-ext-imagick.ini

COPY docker/php/config/php.ini /usr/local/etc/php/
#COPY docker/php/config/blackfire.ini /usr/local/etc/php/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

RUN chown -R www-data:www-data /var/www

VOLUME /var/www

WORKDIR /var/www