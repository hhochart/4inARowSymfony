FROM php:7.2-fpm
LABEL maintainer="guillaume.chauveau@appus.fr"
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y \
    subversion git pkg-config build-essential libevent-dev libssl-dev zip \
    make autoconf libc-dev wget zlib1g-dev
RUN docker-php-ext-install pdo pdo_mysql zip
RUN rm -rf /var/lib/apt/lists/* && rm -rf /tmp/* && apt-get autoremove -y
COPY config /usr/local/etc/php/conf.d/
RUN useradd -ms /bin/bash dev
RUN chown -R dev: /home/dev
ENV HOME /home/dev
VOLUME /home/dev
WORKDIR /var/www/ecv.sf