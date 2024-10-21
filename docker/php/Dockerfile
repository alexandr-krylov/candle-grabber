FROM php:8.3-fpm
ARG UID=1000
ARG GID=1000
ENV UID=${UID}
ENV GID=${GID}
RUN groupadd --gid $GID node \
  && useradd --uid $UID --gid node --shell /bin/bash --create-home node
RUN apt-get update \
    && apt-get -y upgrade \
    && apt-get -y install libzip-dev git unzip
    # && docker-php-ext-install xdebug
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN docker-php-ext-install zip pdo_mysql bcmath
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
  EXPOSE 8080
USER node
CMD ["php-fpm"]
