# Imagen base con Apache y PHP
FROM php:8.2-apache

# Habilita mod_rewrite para URLs amigables
RUN a2enmod rewrite

# Instala la extensión mysqli
RUN docker-php-ext-install mysqli

# Copia los archivos del proyecto al contenedor
COPY . /var/www/html

# Cambia permisos si es necesario
RUN chown -R www-data:www-data /var/www/html

# Establece el directorio público
WORKDIR /var/www/html/public