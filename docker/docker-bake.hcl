/*
 * This file is part of the RssBase project.
 * Copyright (c) Romain Gautier <romain@rssbase.io>
 * This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).
 */

group "default" {
  targets = ["tools", "webserver"]
}

// Special target: https://github.com/docker/metadata-action#bake-definition
target "docker-metadata-action" {}

target "tools" {
  dockerfile = "base.Dockerfile"
  tags       = ["rssbase/internal:tools"]
  target     = "tools"
}
target "webserver" {
  dockerfile = "base.Dockerfile"
  tags       = ["rssbase/internal:webserver"]
  target     = "webserver"
}

# dev
target "devtools" {
  contexts = {
    files = "./files"
    tools = "target:tools"
  }
  dockerfile = "dev.Dockerfile"
  output     = ["type=docker"]
  tags       = ["rssbase/devtools"]
  target     = "devtools"
}
target "dev-webserver" {
  contexts = {
    source-code = "../base/"
    webserver   = "target:webserver"
  }
  dockerfile = "dev.Dockerfile"
  tags       = ["rssbase/webserver:dev"]
  target     = "dev-webserver"
}

# prod
target "prod-webserver" {
  contexts = {
    source-code = "../base/"
    tools       = "target:tools"
    webserver   = "target:webserver"
  }
  dockerfile = "prod.Dockerfile"
  inherits   = ["docker-metadata-action"]
  tags       = ["rssbase/webserver:prod"]
  target     = "prod-webserver"
}
