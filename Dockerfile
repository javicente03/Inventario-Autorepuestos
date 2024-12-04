#  PHP V 7.4.33

FROM php:7.4.33-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf