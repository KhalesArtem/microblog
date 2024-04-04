FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apk update && apk add --no-cache \
   build-base \
   libzip-dev \
   libpng-dev \
   libjpeg-turbo-dev \
   freetype-dev \
   zip \
   jpegoptim optipng pngquant gifsicle \
   vim \
   unzip \
   git \
   curl \
   postgresql-dev \
   nodejs \
   npm

# Install extensions
RUN docker-php-ext-configure zip
RUN docker-php-ext-install pdo pdo_pgsql zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/download/2.5.5/composer.phar -o /usr/local/bin/composer && \
   chmod +x /usr/local/bin/composer

# Install Node.js and npm
RUN apk add --update nodejs npm

# Add user for laravel application
RUN addgroup -g 1000 www
RUN adduser -u 1000 -G www -s /bin/sh -D www

# Copy existing application directory contents
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
