FROM php:8.2-fpm
COPY ./docker/php/php.ini /usr/local/etc/php/

RUN apt-get update \
  && apt-get install --no-install-recommends -y \
  apt-transport-https \
  apt-utils \
  build-essential \
  curl \
  debconf-utils \
  gcc \
  git \
  gnupg2 \
  libfreetype6-dev \
  libicu-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  libpq-dev \
  libzip-dev \
  locales \
  ssl-cert \
  unzip \
  vim \
  zlib1g-dev \
  mariadb-client \
  git \
  libmagickwand-dev \
  && docker-php-ext-install zip pdo_mysql intl sockets \
  && docker-php-ext-install -j$(nproc) gd \
  && apt-get clean \
  && pecl install imagick \
  && docker-php-ext-enable imagick \
  && rm -rf /var/lib/apt/lists/* \
  && echo "en_US.UTF-8 UTF-8" >/etc/locale.gen \
  && locale-gen

# composer
COPY --from=composer /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

# npm
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# laravel
COPY ./src /var/www/src/
WORKDIR /var/www/src/
RUN chmod -R a+w storage/ bootstrap/cache
RUN composer install

WORKDIR /var/www/

RUN rm -rf /var/www/html

# TimeZone settings
ENV TZ Asia/Tokyo
RUN echo "${TZ}" > /etc/timezone \
  && dpkg-reconfigure -f noninteractive tzdata