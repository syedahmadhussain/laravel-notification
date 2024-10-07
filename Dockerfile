FROM php:8.2-fpm-alpine

RUN apk add --no-cache linux-headers
RUN docker-php-ext-install pdo pdo_mysql sockets bcmath
RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

EXPOSE 8000
