FROM php:7.2.2-apache
# Aukerazko 404 web orria apachera gehitu
RUN echo "ErrorDocument 404 /custom_404.html" >> /etc/apache2/apache2.conf
RUN echo "ServerSignature Off" >> /etc/apache2/apache2.conf
RUN echo "ServerTokens Prod" >> /etc/apache2/apache2.conf
RUN echo "expose_php = Off" >> /usr/local/etc/php/php.ini
RUN docker-php-ext-install mysqli
