# Use the official PHP image
FROM php:8.2-apache

# 1. Install PDO and MySQL driver
RUN docker-php-ext-install pdo pdo_mysql

# 2. Enable Apache mod_rewrite (Required for .htaccess)
RUN a2enmod rewrite

# 3. CRITICAL: Configure Apache to allow .htaccess overrides
# By default, Apache blocks .htaccess. This command fixes that.
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# 4. Copy your code
COPY . /var/www/html/

# 5. Set permissions (Optional but recommended for Render)
RUN chown -R www-data:www-data /var/www/html

# Expose Port 80
EXPOSE 80