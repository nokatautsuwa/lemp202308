# PHP 8.2 標準アプリケーションサーバー
FROM php:8.2-fpm

# タイムゾーン(東京)
ENV TZ Asia/Tokyo

# Linux
# mariadb-client : 基本MySQLだがMariaDBを使用することも想定して入れている
RUN apt-get update \
    && apt-get install -y vim unzip git curl \
    libzip-dev libonig-dev libicu-dev libjpeg62-turbo-dev libpng-dev mariadb-client \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# PHP
RUN docker-php-ext-install zip pdo_mysql mysqli mbstring gd iconv bcmath
# ローカルに作成したphp.ini設定をcontainerのphp.iniと同期させる
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
# Composer 2.5.8(マルチステージビルドでインストール)
ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer
COPY --from=composer:2.5.8 /usr/bin/composer /usr/bin/composer

# Node(Debian/root) 18.x(LTS)
RUN : 'Install Node.js' \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && : 'Install PHP Extensions' \
    && apt-get install -y nodejs

# containerでのホームディレクトリを指定
WORKDIR /data