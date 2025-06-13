FROM php:8.2-apache

# Habilita mod_rewrite para URLs amigables
RUN a2enmod rewrite

# Instala extensión mysqli
RUN docker-php-ext-install mysqli

# Copia TODO el proyecto al contenedor
COPY . /var/www/html

# Cambia el directorio de trabajo a public/
WORKDIR /var/www/html/public