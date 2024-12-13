# Указываем базовый образ
FROM php:8.2

# Определяем том для кода
VOLUME /code

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем переменную среды в современном формате
ENV COMPOSER_ALLOW_SUPERUSER=1

# Устанавливаем рабочую директорию
WORKDIR /code
