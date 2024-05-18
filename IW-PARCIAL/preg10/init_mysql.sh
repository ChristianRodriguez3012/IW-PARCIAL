#!/bin/bash

# Inicia el servicio MySQL
service mysql start

# Espera a que MySQL esté en funcionamiento
until mysqladmin ping; do
    sleep 1
done

# Inicializa la base de datos
mysql < /docker-entrypoint-initdb.d/createDB.mysql

# Inicia el servicio Apache
service apache2 start

# Mantiene el contenedor en ejecución
tail -f /dev/null
