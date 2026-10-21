FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

FROM php:8.5-apache

RUN a2enmod rewrite headers deflate expires \
    && sed -ri 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# $_ENV population for the MAIL_* vars Coolify injects as container env vars
RUN { \
        echo 'variables_order = EGPCS'; \
    } > /usr/local/etc/php/conf.d/env-vars.ini

WORKDIR /var/www/html
COPY --from=vendor /app/vendor ./vendor
COPY . .

RUN mkdir -p logs \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R u+rwX,g+rwX logs
