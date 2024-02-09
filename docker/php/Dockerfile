FROM php:8.3-fpm
# ARG UID=1000
# ARG GID=1000
# ENV UID=${UID}
# ENV GID=${GID}
# RUN groupadd --gid $GID pool \
#   && useradd --uid $UID --gid pool --shell /bin/bash --create-home www
RUN apt-get update \
    && apt-get -y upgrade \
    && apt-get -y install libzip-dev git unzip
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN docker-php-ext-install zip
# USER www
EXPOSE 8080

CMD ["php-fpm"]
