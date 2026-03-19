FROM php:8.4-fpm

# Dependências do sistema + ferramentas úteis
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    default-mysql-client \
    iputils-ping \
    vim \
    # 🔥 ADICIONADO: dependências necessárias para instalar extensões via PECL
    autoconf \
    build-essential \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        zip

# 🔥 ADICIONADO: instalação do PCOV (driver de coverage)
RUN pecl install pcov \
    && docker-php-ext-enable pcov

# 🔥 ADICIONADO: configuração do PCOV
RUN echo "pcov.enabled=1" >> /usr/local/etc/php/conf.d/pcov.ini \
    && echo "pcov.directory=/app" >> /usr/local/etc/php/conf.d/pcov.ini

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

CMD ["php-fpm"]
