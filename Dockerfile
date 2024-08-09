FROM php:8.1.8-fpm-alpine

# Set environment variables
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN docker-php-ext-install pdo pdo_mysql    

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy the application code
COPY ./src .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Ensure storage directory has correct permissions
RUN chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage

# Copy .env.example to .env
RUN cp .env.example .env

RUN php artisan key:generate

# Expose the port the app runs on
EXPOSE 9000

# Command to run the application
CMD ["php-fpm"]