#syntax=docker/dockerfile-upstream:1

# This file is part of the RssBase project.
# Copyright (c) Romain Gautier <romain@rssbase.io>
# This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).


FROM web-server AS dev-web-server
COPY --link --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN <<EOF
  install-php-extensions \
    xdebug

  echo 'xdebug.mode=debug'                       >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
  echo 'xdebug.log=/app/var/log/xdebug.log'      >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
  echo 'xdebug.client_host=host.docker.internal' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
EOF
