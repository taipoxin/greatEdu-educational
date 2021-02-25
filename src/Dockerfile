FROM php:fpm
WORKDIR /app

# Install dependencies
# RUN curl -sL https://deb.nodesource.com/setup_8.x | bash -
RUN apt-get update && apt-get install -y \
    # git \
    # nodejs \
    zip
RUN curl -sL https://getcomposer.org/installer | php -- --install-dir /usr/bin --filename composer

# Get application dependencies
COPY composer.json ./
RUN composer update
RUN composer install -o

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy application
COPY . ./
