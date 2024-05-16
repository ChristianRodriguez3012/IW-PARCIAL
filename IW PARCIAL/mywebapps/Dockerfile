# Use Ubuntu 18.04 as base image
FROM ubuntu:18.04

# Set noninteractive mode for apt-get
ENV DEBIAN_FRONTEND=noninteractive

# Install Apache HTTP Server, PHP, y MySQL Client
RUN apt-get update && apt-get install -y apache2 php libapache2-mod-php mysql-client mysql-server

# Enable Apache modules
RUN a2enmod rewrite
RUN a2enmod alias

# Add virtual host configuration
COPY 000-default.conf /etc/apache2/sites-available/

# Create necessary directories
RUN mkdir -p /var/www/html/iw_parcial

# Copy webapp files
COPY webapp_01 /var/www/html/iw_parcial

# Copy petclinic PHP file
COPY webapp_01/petclinic.php /var/www/html/iw_parcial

# Copy test PHP file
COPY test.php /var/www/html/iw_parcial/test.php

# Copy script de creación de la base de datos
COPY createDB.mysql /createDB.mysql

# Ejecutar el script de creación de la base de datos durante la construcción de la imagen
RUN service mysql start && \
    mysql -u root -p < /createDB.mysql

# Expose port 80
EXPOSE 80

# Start Apache server in foreground
CMD ["apachectl", "-D", "FOREGROUND"]
