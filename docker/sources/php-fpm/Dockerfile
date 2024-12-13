FROM php:8.4.1-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y \
    procps \
    curl \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    redis-server \
    supervisor

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip

RUN pecl install redis \
    && docker-php-ext-enable redis

COPY --from=composer:2.8.3 /usr/bin/composer /usr/local/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/backend $user

RUN chmod 775 /var/run && chown $user:$user /var/run
COPY ./supervisord.conf /etc/supervisor/supervisord.conf
COPY ./entrypoint-supervisor.sh /usr/local/bin/entrypoint-supervisor.sh
RUN chmod +x /usr/local/bin/entrypoint-supervisor.sh

RUN mkdir -p /home/backend/.composer && chown -R $user:$user /home/backend

RUN apt-get install sudo
RUN apt-get install --reinstall bash
RUN apt-get install --reinstall bash-completion

USER $user

VOLUME /var/lib/mysql
VOLUME /home/backend

WORKDIR /home/backend

EXPOSE 80
EXPOSE 22
EXPOSE 443

ENTRYPOINT ["/usr/local/bin/entrypoint-supervisor.sh"]
