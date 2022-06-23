ARG FLUX_PHP_BACKPORT_IMAGE=docker-registry.fluxpublisher.ch/flux-php-backport

FROM $FLUX_PHP_BACKPORT_IMAGE:v2022-06-23-1 AS build

COPY . /build/flux-ilias-rest-helper-plugin

RUN php-backport /build/flux-ilias-rest-helper-plugin FluxIliasRestApi\\Libs\\FluxLegacyEnum

RUN (cd /build && tar -czf flux-ilias-rest-helper-plugin.tar.gz flux-ilias-rest-helper-plugin)

FROM scratch

LABEL org.opencontainers.image.source="https://github.com/flux-caps/flux-ilias-rest-helper-plugin"
LABEL maintainer="fluxlabs <support@fluxlabs.ch> (https://fluxlabs.ch)"
LABEL flux-docker-registry-rest-api-build-path="/flux-ilias-rest-helper-plugin.tar.gz"

COPY --from=build /build /

ARG COMMIT_SHA
LABEL org.opencontainers.image.revision="$COMMIT_SHA"
