#syntax=docker/dockerfile-upstream:1
# https://hub.docker.com/r/docker/dockerfile-upstream
# https://github.com/moby/buildkit/blob/master/frontend/dockerfile/docs/reference.md

FROM php:8.1 AS php
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
