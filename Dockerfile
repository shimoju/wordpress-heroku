FROM php:7.1.3-apache

ENV LANG=C.UTF-8 \
  LC_ALL=C.UTF-8 \
  DEBIAN_FRONTEND=noninteractive

RUN apt-get update -qq && apt-get install -qq curl \
  && curl -fsSL https://deb.nodesource.com/setup_8.x | bash - \
  && apt-get install -qq --no-install-recommends \
    build-essential \
    nodejs \
    git \
    less \
    mysql-client \
    libjpeg-dev \
    libpng-dev \
  && rm -rf /var/lib/apt/lists/* \
  && docker-php-ext-configure gd --with-jpeg-dir=/usr --with-png-dir=/usr \
  && docker-php-ext-install gd mysqli opcache zip \
  # Composer
  && curl -fsSLo composer-setup.php https://getcomposer.org/installer \
  && echo '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410 composer-setup.php' | sha384sum -c - \
  && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
  && rm composer-setup.php \
  && composer config -g repos.packagist composer https://packagist.jp \
  && composer global require hirak/prestissimo

ENV APP_ROOT=/app
ENV DOCUMENT_ROOT=$APP_ROOT/public

WORKDIR $APP_ROOT

RUN { \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.interned_strings_buffer=8'; \
    echo 'opcache.max_accelerated_files=4000'; \
    echo 'opcache.revalidate_freq=2'; \
    echo 'opcache.fast_shutdown=1'; \
    echo 'opcache.enable_cli=1'; \
  } > /usr/local/etc/php/conf.d/opcache-recommended.ini \
  && { \
    echo '<VirtualHost *:80>'; \
    echo '  DocumentRoot ${DOCUMENT_ROOT}'; \
    echo '  ErrorLog ${APACHE_LOG_DIR}/error.log'; \
    echo '  CustomLog ${APACHE_LOG_DIR}/access.log combined'; \
    echo '  <Directory ${DOCUMENT_ROOT}>'; \
    echo '    AllowOverride None'; \
    echo '    Require all granted'; \
    echo '    RewriteEngine On'; \
    echo '    RewriteBase /'; \
    echo '    RewriteRule ^index\.php$ - [L]'; \
    echo '    RewriteCond %{REQUEST_FILENAME} !-f'; \
    echo '    RewriteCond %{REQUEST_FILENAME} !-d'; \
    echo '    RewriteRule . /index.php [L]'; \
    echo '  </Directory>'; \
    echo '</VirtualHost>'; \
  } > ${APACHE_CONFDIR}/sites-available/000-default.conf \
  && a2enmod rewrite expires
