# Use official PHP + Apache base image
FROM php:8.2-apache

# Enable rewrite module
RUN a2enmod rewrite

# Set index.php as default directory index
RUN echo "DirectoryIndex index.php" > /etc/apache2/conf-enabled/directoryindex.conf

# Copy project files
COPY . /var/www/html/

# File permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
