#  PHP V 7.4.33

FROM php:7.4.33-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libmcrypt-dev \
    libicu-dev \
    libxml2-dev \
    libxslt-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    libpq-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql zip exif pcntl gd intl xsl mbstring curl json xml soap bcmath opcache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable apache modules
RUN a2enmod rewrite headers

# Copy apache vhost file to sites-available
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy php.ini file to container
COPY php.ini /usr/local/etc/php/php.ini

# Set working directory
WORKDIR /var/www/html

# Expose port 80
EXPOSE 80