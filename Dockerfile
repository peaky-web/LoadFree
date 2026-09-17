FROM php:8.2-apache

# Install MySQL/PDO support
RUN docker-php-ext-install pdo_mysql

# Enable URL rewriting
RUN a2enmod rewrite

# Copy LoadFree website
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Make Apache use Railway's PORT
CMD ["bash", "-c", "\
PORT=${PORT:-80}; \
a2dismod mpm_event mpm_worker || true; \
rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.*; \
a2enmod mpm_prefork; \
sed -i -E \"s/^Listen [0-9]+/Listen ${PORT}/\" /etc/apache2/ports.conf; \
sed -i -E \"s/<VirtualHost \\*:[0-9]+>/<VirtualHost *:${PORT}>/\" /etc/apache2/sites-available/000-default.conf; \
apache2ctl -t; \
exec apache2-foreground"]

EXPOSE 80