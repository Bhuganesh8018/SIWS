# Use official PHP + Apache base image
FROM php:8.2-apache

# Enable Apache rewrite module (optional but recommended)
RUN a2enmod rewrite

# Copy project files to Apache's document root
COPY . /var/www/html/

# Give proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80 (Render uses this internally)
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
  
