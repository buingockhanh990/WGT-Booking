# Change php version here
FROM php:7.4-fpm

# Install additional packages
RUN apt-get update && apt-get install -y \
    cron \
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

# Install crontab
RUN echo "* * * * * www-data php /var/www/html/bin/magento cron:run 2>&1 | grep -v \"Ran jobs by schedule\" >> /var/www/html/var/log/magento.cron.log" >> /etc/crontab
RUN chmod gu+rw /var/run && chmod gu+s /usr/sbin/cron

# Start cron service
CMD ["cron", "-f"]

# Give correct permission
RUN usermod -u 1000 www-data