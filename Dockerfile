# Use the official PHP image
FROM php:8.2-apache

# 1. Install PDO and MySQL driver
RUN docker-php-ext-install pdo pdo_mysql

# 2. Enable Apache mod_rewrite
RUN a2enmod rewrite

# 3. CRITICAL: Configure Apache to allow .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# --- NEW STEP 4: CHANGE DOCUMENT ROOT TO /public ---
# This tells Apache to serve the "public" folder, not the root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
# ---------------------------------------------------

# 5. Copy your code
COPY . /var/www/html/

# 6. Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose Port 80
EXPOSE 80