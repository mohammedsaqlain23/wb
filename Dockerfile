# Use an official PHP image with Apache
FROM php:8.1-apache

# Set working directory
WORKDIR /var/www/html

# Copy application files to container
COPY . .

# Install necessary PHP extensions (optional, adjust as needed)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Expose port 80
EXPOSE 80

# Start Apache in foreground mode
CMD ["apache2-foreground"]
