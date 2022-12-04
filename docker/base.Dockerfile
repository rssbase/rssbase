#syntax=docker/dockerfile-upstream:1

# This file is part of the RssBase project.
# Copyright (c) Romain Gautier <romain@rssbase.io>
# This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).


FROM caddy:2.6-builder AS caddy-build
RUN <<EOF
  xcaddy build \
    --with github.com/baldinof/caddy-supervisor
EOF


FROM php:8.1-fpm AS php
WORKDIR /app


FROM php AS tools
COPY --link --from=composer:2 /usr/bin/composer /usr/bin/
COPY --link --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN <<EOF
  install-php-extensions \
    intl \
    zip
EOF


FROM php AS webserver
RUN --mount=type=bind,from=mlocati/php-extension-installer,source=/usr/bin/install-php-extensions,target=/usr/local/bin/install-php-extensions <<EOF
  install-php-extensions \
    bcmath \
    intl \
    apcu \
    opcache
EOF
COPY --link --from=caddy-build /usr/bin/caddy /usr/bin/caddy
COPY --link <<EOF /etc/caddy/Caddyfile
{
  supervisor {
    php-fpm
  }
}
:80
php_fastcgi unix//var/run/php-fpm.sock
root * /app/public
encode gzip
file_server
EOF
COPY --link <<EOF /usr/local/etc/php-fpm.d/zz-docker.conf
[www]
listen = /var/run/php-fpm.sock
EOF
CMD ["caddy", "run", "--config", "/etc/caddy/Caddyfile", "--adapter", "caddyfile"]
