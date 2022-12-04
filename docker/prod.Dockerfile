#syntax=docker/dockerfile-upstream:1

# This file is part of the RssBase project.
# Copyright (c) Romain Gautier <romain@rssbase.io>
# This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).


FROM tools AS build
ENV APP_ENV=prod
COPY --link --from=source-code composer.* symfony.lock ./
RUN <<EOF
  set -eux
  composer install \
    --prefer-dist \
    --no-dev \
    --no-autoloader \
    --no-scripts \
    --no-progress
  composer clear-cache
EOF
COPY --link --from=source-code bin       ./bin
COPY --link --from=source-code config    ./config
COPY --link --from=source-code public    ./public
COPY --link --from=source-code src       ./src
COPY --link --from=source-code templates ./templates
COPY --link --from=source-code .*        ./
RUN <<EOF
set -eux
  composer dump-autoload \
    --classmap-authoritative \
    --no-dev
  composer dump-env prod
  composer run-script post-install-cmd \
    --no-dev
EOF


FROM webserver AS prod-webserver
ENV APP_ENV=prod
COPY --link --from=source-code bin       ./bin
COPY --link --from=source-code config    ./config
COPY --link --from=source-code public    ./public
COPY --link --from=source-code src       ./src
COPY --link --from=source-code templates ./templates
COPY --link --from=build  /app/var       ./var
COPY --link --from=build  /app/vendor    ./vendor
COPY --link --from=build  /app/.*.php    ./
