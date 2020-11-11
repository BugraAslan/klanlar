FROM nginx:1.17

RUN apt-get update -y && apt-get install -y \
    curl

RUN mkdir -p /var/www \
    && usermod -u 5000 www-data \
    && chown -R www-data:www-data /var/www

COPY docker/nginx/default.conf.dist /etc/nginx/conf.d/default.conf

EXPOSE 8090

VOLUME /var/www/

WORKDIR /var/www