FROM php:7.3.4-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN apt-get update \
&& apt-get install -y apt-utils vim curl sqlite3 \
&& pecl install xdebug

ADD ./php.ini /usr/local/etc/php/

ADD ./sites /etc/apache2/sites-available

RUN a2ensite httpd.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Git
RUN apt-get update
RUN apt-get install -y git

EXPOSE 80
