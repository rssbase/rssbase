/*
 * This file is part of the RssBase project.
 * Copyright (c) Romain Gautier <romain@rssbase.io>
 * This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).
 */

group "default" {
  targets = ["web-server"]
}

// Special target: https://github.com/docker/metadata-action#bake-definition
target "docker-metadata-action" {}

target "web-server" {
  dockerfile = "base.Dockerfile"
  output     = ["type=docker"]
  tags       = ["rssbase-web-server"]
  target     = "web-server"
}

target "tools" {
  dockerfile = "base.Dockerfile"
  output     = ["type=docker"]
  tags       = ["rssbase-tools"]
  target     = "tools"
}

target "dev-web-server" {
  inherits = ["docker-metadata-action"]
  contexts = {
    source-code = "../base/"
    web-server  = "target:web-server"
  }
  dockerfile = "dev.Dockerfile"
  tags       = ["rssbase-dev-web-server"]
  target     = "dev-web-server"
}

target "prod-web-server" {
  inherits = ["docker-metadata-action"]
  contexts = {
    source-code = "../base/"
    tools       = "target:tools"
    web-server  = "target:web-server"
  }
  dockerfile = "prod.Dockerfile"
  tags       = ["rssbase-prod-web-server"]
  target     = "prod-web-server"
}
