# Use the official PHP image
FROM php:8.2-apache

# Install PDO and the MySQL driver for PDO
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite (Good for routing)
RUN a2enmod rewrite

# Copy your code
COPY . /var/www/html/

# Expose Port 80
EXPOSE 80