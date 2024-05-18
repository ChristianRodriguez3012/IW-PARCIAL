# Usa Ubuntu 18.04
FROM ubuntu:18.04

# Establece la variable de entorno para evitar que tzdata solicite entrada
ENV DEBIAN_FRONTEND=noninteractive

# Actualiza los paquetes del sistema e instala Apache, PHP, MySQL y herramientas necesarias
RUN apt-get update && apt-get install -y \
    # Servidor web Apache
    apache2 \
    # Lenguaje de programación PHP
    php \
    # Módulo de Apache para PHP
    libapache2-mod-php \
    # Extensión de PHP para MySQL
    php-mysql \
    # Servidor de base de datos MySQL
    mysql-server \
    # Herramienta para transferir datos con URL
    curl

# Configura la zona horaria
RUN ln -fs /usr/share/zoneinfo/Etc/UTC /etc/localtime && \
    dpkg-reconfigure --frontend noninteractive tzdata

# Crea el directorio para la aplicación web
RUN mkdir -p /mywebapps/webapp_01

# Copia los archivos de la aplicación al contenedor
COPY hola.html /mywebapps/webapp_01/hola.html
COPY hola.php /mywebapps/webapp_01/hola.php
COPY petclinic.php /mywebapps/webapp_01/petclinic.php

# Configura el host virtual de Apache
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /mywebapps/webapp_01\n\
    Alias "/iw_parcial" "/mywebapps/webapp_01"\n\
    <Directory "/mywebapps/webapp_01">\n\
        AllowOverride None\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Configura MySQL para que acepte conexiones remotas
RUN sed -i 's/bind-address.*/bind-address = 0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf

# Expone los puertos 80 (Apache) y 3306 (MySQL)
EXPOSE 80
EXPOSE 3306

# Inicia Apache y MySQL en primer plano
CMD service apache2 start && service mysql start && tail -f /dev/null