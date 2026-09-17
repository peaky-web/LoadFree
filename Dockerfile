FROM php:8.2-apache

# Install MySQL/PDO support
RUN docker-php-ext-install pdo pdo_mysql

# Enable URL rewriting
RUN a2enmod rewrite

# Copy the LoadFree website into Apache
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80