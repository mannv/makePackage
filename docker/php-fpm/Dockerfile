#
#--------------------------------------------------------------------------
# Image Setup
#--------------------------------------------------------------------------
#

FROM php:7.3-fpm

#
#--------------------------------------------------------------------------
# Software's Installation
#--------------------------------------------------------------------------
#
# Installing tools and PHP extentions using "apt", "docker-php", "pecl",
#

# Install "curl", "libmemcached-dev", "libpq-dev", "libjpeg-dev",
#         "libpng-dev", "libfreetype6-dev", "libssl-dev", "libmcrypt-dev",
RUN apt-get update && \
  apt-get upgrade -y && \
  apt-get install -y --no-install-recommends \
    curl \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev \
  && rm -rf /var/lib/apt/lists/*



  # Install the PHP pdo_mysql extention
  RUN docker-php-ext-install pdo_mysql \
  # Install the PHP pdo_pgsql extention
  && docker-php-ext-install pdo_pgsql \
  # Install the PHP gd library
  && docker-php-ext-configure gd \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2 && \
    docker-php-ext-install gd


# Set Environment Variables
ENV DEBIAN_FRONTEND noninteractive
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

# always run apt update when start and after add new source list, then clean up at end.
RUN set -xe; \
    apt-get update -yqq && \
    pecl channel-update pecl.php.net && \
    apt-get install -yqq \
      apt-utils \
      #
      #--------------------------------------------------------------------------
      # Mandatory Software's Installation
      #--------------------------------------------------------------------------
      #
      # Mandatory Software's such as ("mcrypt", "pdo_mysql", "libssl-dev", ....)
      # are installed on the base image 'laradock/php-fpm' image. If you want
      # to add more Software's or remove existing one, you need to edit the
      # base image (https://github.com/Laradock/php-fpm).
      #
      # next lines are here becase there is no auto build on dockerhub see https://github.com/laradock/laradock/pull/1903#issuecomment-463142846
      libzip-dev zip unzip && \
      docker-php-ext-configure zip; \
      # Install the zip extension
      docker-php-ext-install zip && \
      php -m | grep -q 'zip'

USER root

COPY ./xhprof.ini /usr/local/etc/php/conf.d

###########################################################################
# Opcache:
###########################################################################
RUN docker-php-ext-install opcache

# Copy opcache configration
COPY ./opcache.ini /usr/local/etc/php/conf.d/opcache.ini

###########################################################################
# Mysqli Modifications:
###########################################################################
RUN docker-php-ext-install mysqli

###########################################################################
# bcmath:
###########################################################################
RUN docker-php-ext-install bcmath

###########################################################################
# Human Language and Character Encoding Support:
###########################################################################
RUN apt-get install -y zlib1g-dev libicu-dev g++ && \
        docker-php-ext-configure intl && \
        docker-php-ext-install intl

###########################################################################
# ImageMagick:
###########################################################################
RUN apt-get install -y libmagickwand-dev imagemagick && \
        pecl install imagick && \
        docker-php-ext-enable imagick

###########################################################################
# Image optimizers:
###########################################################################

RUN apt-get install -y jpegoptim optipng pngquant gifsicle

###########################################################################
# PHP REDIS EXTENSION
###########################################################################

ARG INSTALL_PHPREDIS=false

RUN if [ $(php -r "echo PHP_MAJOR_VERSION;") = "5" ]; then \
      pecl install -o -f redis-4.3.0; \
    else \
      pecl install -o -f redis; \
    fi \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# install composer
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#
COPY ./laravel.ini /usr/local/etc/php/conf.d
COPY ./xlaravel.pool.conf /usr/local/etc/php-fpm.d/

USER root

# Clean up
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

#--------------------------------------------------------------------------
# Crontab
#--------------------------------------------------------------------------
RUN apt-get update && \
    apt-get install -y cron

ADD ./config/crontab/vitop /opt/vitop


#--------------------------------------------------------------------------
# supervisor
#--------------------------------------------------------------------------
USER root
RUN apt-get update && \
    apt-get install -y supervisor

ADD ./config/supervisord.conf /etc/supervisor/supervisord.conf
RUN ln -s /var/www/supervisor/config.conf /etc/supervisor/conf.d/config.conf
#--------------------------------------------------------------------------
# Set Timezone
#--------------------------------------------------------------------------
ENV TZ Asia/Bangkok
RUN apt-get install -y tzdata \
    && cp /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo $TZ > /etc/timezone


RUN docker-php-ext-install exif && \
    docker-php-ext-enable exif

RUN apt-get update && apt-get install -y htop git


#--------------------------------------------------------------------------
# install wkhtmltopdf
# https://wkhtmltopdf.org/
#--------------------------------------------------------------------------
ADD ./tools/wkhtmltox_0.12.5-1.deb /wkhtmltox.deb
RUN dpkg --configure -a
RUN apt-get install -y xvfb libfontconfig fontconfig libpng16-16 libxrender1 xfonts-75dpi build-essential xorg
RUN dpkg -i /wkhtmltox.deb
RUN rm -f /wkhtmltox.deb

#--------------------------------------------------------------------------
# add php7.3.ini
#--------------------------------------------------------------------------
ADD php7.3.ini /usr/local/etc/php/php.ini
ADD ./startup.sh /opt/startup.sh

USER www-data

WORKDIR /var/www

ENTRYPOINT ["/bin/bash"]
CMD ["/opt/startup.sh"]

EXPOSE 9000 9001

#--------------------------------------------------------
# nếu có thay đổi gì trong Dockerfile mà cần phải build lại images trên docker hub
# https://hub.docker.com/repository/docker/vitopvn/php-fpm
# thì bổ sung bên dưới sau đó chạy lệnh build
# -------------- chạy lệnh để build và push lên docker hub ----------------
# docker tag historia_php-fpm vitopvn/php-fpm
# docker push vitopvn/php-fpm
#--------------------------------------------------------
