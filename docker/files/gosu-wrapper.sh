#!/usr/bin/env bash

# This file is part of the RssBase project.
# Copyright (c) Romain Gautier <romain@rssbase.io>
# This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).

set -eou pipefail

create-group-and-user () {
  (
    getent group mygroup || \
    addgroup \
      --gid $DIRECTORY_GID \
      mygroup

    getent passwd myuser || \
    (
      adduser \
        --gecos "" \
        --no-create-home \
        --disabled-password \
        --home /home \
        --uid $DIRECTORY_UID \
        --gid $DIRECTORY_GID \
        myuser
      chown $DIRECTORY_UID:$DIRECTORY_GID /home
    )
  ) > /dev/null
}

DIRECTORY_UID=$(stat -c %u /app)
DIRECTORY_GID=$(stat -c %g /app)

if [ $DIRECTORY_UID == 0 ] && [ $DIRECTORY_GID == 0 ]; then
  exec $*
else
  create-group-and-user
  exec gosu myuser $*
fi
