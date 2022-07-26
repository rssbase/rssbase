# Docker

## Requirements

- docker & [docker buildx](https://github.com/docker/buildx)

## Usage

```
$ make
dev                            Build dev docker images
prod                           Build prod docker image

$ make dev prod
```

## Some links

- `#syntax=docker/dockerfile-upstream`: https://hub.docker.com/r/docker/dockerfile-upstream
- Dockerfile reference: https://github.com/moby/buildkit/blob/master/frontend/dockerfile/docs/reference.md
- Dockerfile heredocs: https://www.docker.com/blog/introduction-to-heredocs-in-dockerfiles/
- `docker buildx bake` cli: https://docs.docker.com/engine/reference/commandline/buildx_bake/
- `docker-bake.chl` file:https://docs.docker.com/build/customize/bake/file-definition/
- `docker-bake.hcl` example: https://github.com/crazy-max/diun/blob/master/docker-bake.hcl
- https://www.youtube.com/watch?v=mgW61S7izcc
- https://github.com/docker/buildx/blob/master/docs/guides/opentelemetry.md
