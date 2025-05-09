# Use the official ServerSideUp PHP 8.3 + Nginx image (Debian-based)
FROM serversideup/php:8.3-fpm-nginx

LABEL maintainer="HENG Sunhour <sunhour012@gmail.com>"

ARG UID=33
ARG GID=33

USER root

RUN docker-php-serversideup-s6-init

RUN install-php-extensions intl

USER www-data

COPY --chown=www-data:www-data composer.json composer.lock ./


RUN composer install --no-dev \
	 --optimize-autoloader

# Optional: Tweak PHP/Nginx via ENV vars
ENV PHP_MEMORY_LIMIT=256M \
    PHP_UPLOAD_MAX_FILESIZE=64M \
    NGINX_DOCUMENT_ROOT=/var/www/html/public

# Health check (already included in the image)
COPY --chown=www-data:www-data . /var/www/html
# EXPOSE 80 is also preconfigured