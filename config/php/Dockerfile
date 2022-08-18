# Change php version here
FROM php:8.1-fpm

# Install additional packages
RUN apt-get update && apt-get install -y \
    curl \
    git \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libpng-dev \
    libxml2-dev \
    libxslt-dev \
    libzip-dev \
    openssl \
    unzip \
    zip

# Configuration for PHP 7.1 - 7.3
#RUN docker-php-ext-configure intl && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && docker-php-ext-configure zip
# Configuration for PHP 7.4
RUN docker-php-ext-configure intl && docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-configure zip

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    bcmath \
    gd \
    intl \
    pdo_mysql \
    soap \
    xsl \
    sockets \
    zip

# Install Xdebug
#For php5.6: pecl install xdebug-2.5.5
RUN pecl install xdebug && docker-php-ext-enable xdebug;

# Install composer 2 since magento 2.4.2, use command COPY --from=composer
# For magento < 2.4.2, use command COPY --from=composer:1
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

# Precreate folder and given the permission
RUN mkdir -p /var/www/.composer/cache && echo "{}" > /var/www/.composer/composer.json && chown -R www-data:www-data /var/www/ && chmod -R 775 /var/www/

# Install Nodejs
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - && apt-get install -y nodejs && npm install -g grunt-cli

# Give correct permission
RUN usermod -u 1000 www-data