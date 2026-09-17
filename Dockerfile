FROM php:8.2-apache

# Install MySQL PDO driver
RUN docker-php-ext-install pdo_mysql

# Make sure Apache uses only prefork MPM
RUN a2dismod mpm_event mpm_worker mpm_event 2>/dev/null || true
RUN a2enmod mpm_prefork

# Copy LoadFree files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Railway provides the PORT environment variable
CMD ["apache2-foreground"]