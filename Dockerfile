# Use official PHP Apache image
FROM php:8.2-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite (for Laravel or other frameworks)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files to the container
COPY . .

# Expose port 80 for web traffic
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
