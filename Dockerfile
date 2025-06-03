FROM php:5.6-apache

# Corrige repositórios desatualizados
RUN sed -i '/stretch-updates/d' /etc/apt/sources.list && \
    sed -i 's|http://deb.debian.org/debian|http://archive.debian.org/debian|g' /etc/apt/sources.list && \
    sed -i 's|http://security.debian.org/debian-security|http://archive.debian.org/debian-security|g' /etc/apt/sources.list && \
    echo 'Acquire::Check-Valid-Until "false";' > /etc/apt/apt.conf.d/99no-check-valid-until

# Instala pacotes e extensões
RUN apt-get update && apt-get install -y --allow-unauthenticated \
    libicu-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    tzdata && \
    docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    mbstring \
    intl \
    xml \
    ctype \
    tokenizer \
    json \
    zip \
    fileinfo && \
    a2enmod rewrite

# Define fuso horário
ENV TZ=America/Sao_Paulo

# Configura o php.ini para fuso horário e formato de hora
RUN echo "date.timezone = America/Sao_Paulo" >> /usr/local/etc/php/php.ini \
    && echo "intl.default_locale = pt_BR" >> /usr/local/etc/php/php.ini

RUN pecl install redis-4.3.0 && docker-php-ext-enable redis

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia virtual host
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Copia código
COPY . /var/www/html/

# Define permissões
RUN chown -R www-data:www-data /var/www/html
