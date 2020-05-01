FROM php:7.1-apache-stretch

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        less \
        telnet \
        vim && \
    rm -rf /var/lib/apt/lists/*

RUN cd /tmp && \
    curl -sSO https://files.appoptics.com/appoptics-php.sh && \
    bash appoptics-php.sh --service-key=change-me

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY . .