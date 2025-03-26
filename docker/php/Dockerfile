FROM php:8.3-fpm

# Instala extensões do PHP e dependências
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define timezone
RUN cp /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime && \
    echo "America/Sao_Paulo" > /etc/timezone

# Instala as dependências do Node.js e npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
&& apt-get install -y nodejs

# (Opcional) Verifica as versões
RUN node -v && npm -v

# Define diretório de trabalho
WORKDIR /var/www