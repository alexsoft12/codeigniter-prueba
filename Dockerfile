FROM php:7.3-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y

RUN mkdir -p /var/lock/apache2 /var/run/apache2 /var/log/supervisor
RUN a2enmod ssl rewrite
RUN { \
    echo '<VirtualHost *:80>';\
    	echo 'ServerAdmin webmaster@localhost';\
    	echo 'DocumentRoot /var/www/html';\
    	echo 'ErrorLog ${APACHE_LOG_DIR}/error.log';\
    	echo 'CustomLog ${APACHE_LOG_DIR}/access.log combined';\
    	echo 'SetEnv HTTPS ${FORCE_HTTPS}';\
    echo '</VirtualHost>';\
} > /etc/apache2/sites-available/000-default.conf
ENV HTTPS off
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN echo "export FORCE_HTTPS=\${HTTPS}" >> /etc/apache2/envvars
