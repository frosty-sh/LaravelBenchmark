FROM php:7.4-fpm-alpine

WORKDIR /var/www/html

RUN apk add autoconf gcc g++ make libffi-dev openssl-dev unixodbc-dev\
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql\
    && pecl install sqlsrv \
    && pecl install pdo_sqlsrv  \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv\
    && curl -O https://download.microsoft.com/download/e/4/e/e4e67866-dffd-428c-aac7-8d28ddafb39b/msodbcsql17_17.5.2.2-1_amd64.apk\
    && curl -O https://download.microsoft.com/download/e/4/e/e4e67866-dffd-428c-aac7-8d28ddafb39b/mssql-tools_17.5.2.1-1_amd64.apk\
    && apk add --allow-untrusted msodbcsql17_17.5.2.2-1_amd64.apk\
    && apk add --allow-untrusted mssql-tools_17.5.2.1-1_amd64.apk\