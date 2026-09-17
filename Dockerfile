FROM php:8.2-apache

# Install MySQL/PDO support
RUN docker-php-ext-install pdo_mysql

# Enable URL rewriting
RUN a2enmod rewrite

# Copy LoadFree website
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Make sure Apache starts with ONLY mpm_prefork
CMD ["bash", "-c", "a2dismod mpm_event mpm_worker || true; rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.*; a2enmod mpm_prefork; apache2ctl -t; exec apache2-foreground"]

EXPOSE 80