FROM nginx/unit:1.17.0-php7.3

EXPOSE 8080

COPY ./config/config.json /docker-entrypoint.d/

RUN apt-get update \
    && apt-get install -y \
    php-pgsql php-mysql php-mysqlnd php-pdo php-calendar php-ctype php-exif php-fileinfo php-ftp php-gettext php-iconv php-json php-mysqli php-phar php-posix php-readline php-shmop php-sockets php-sysvmsg php-sysvsem php-sysvshm php-tokenizer php-curl php-soap git