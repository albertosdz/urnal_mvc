FROM php:8.2-apache

# Habilita mod_rewrite
RUN a2enmod rewrite

# Instala extensiones necesarias
RUN docker-php-ext-install mysqli

# Copia el archivo de configuración de Apache personalizado
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copia el contenido del proyecto al contenedor
COPY . /var/www/html

# Establece permisos adecuados (opcional, por si acaso)
RUN chown -R www-data:www-data /var/www/html

# Exponemos el puerto por defecto de Apache (opcional para claridad)
EXPOSE 80