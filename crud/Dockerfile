# Use an official PHP image with required extensions
FROM php:8.2-cli

# Set the working directory
WORKDIR /app

# Install system dependencies, and PHP extensions required by Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the application files into the container
COPY . .

# Install PHP dependencies (composer packages)
RUN composer install --no-dev --optimize-autoloader

# Expose the port Laravel will run on
EXPOSE 8000

# Run Laravel's built-in web server
CMD php artisan serve --host=0.0.0.0 --port=8000
