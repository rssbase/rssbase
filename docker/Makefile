# This file is part of the RssBase project.
# Copyright (c) Romain Gautier <romain@rssbase.io>
# This source code is distributed under the terms of both the MIT license and the Apache License (v2.0).

SHELL := bash
.ONESHELL:
.SHELLFLAGS := -eu -o pipefail -c
.DELETE_ON_ERROR:
MAKEFLAGS += --warn-undefined-variables
MAKEFLAGS += --no-builtin-rules

BAKE = docker buildx bake

.PHONY: %
%:
	$(BAKE) $@

.PHONY: base
base:
	$(BAKE) tools webserver

.PHONY: dev
dev: ## Build dev docker images
	$(BAKE) devtools dev-webserver

.PHONY: prod
prod: ## Build prod docker image
prod: prod-webserver


.PHONY: clean
clean: ## Remove docker images
	-docker rmi `grep 'tags' docker-bake.hcl | cut -d'"' -f 2`

.DEFAULT_GOAL := help
help: Makefile
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
