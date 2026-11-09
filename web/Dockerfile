
FROM php:8.2-apache

# Extensión de PHP para hablar con MySQL mediante PDO
RUN docker-php-ext-install pdo pdo_mysql \
    && echo "ServerName localhost" > /etc/apache2/conf-available/servername.conf \
    && a2enconf servername


COPY php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Código de la aplicación
WORKDIR /var/www/html
COPY src/ /var/www/html/
RUN chown -R www-data:www-data /var/www/html

# Puerto en el que escucha Apache dentro del contenedor
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]
