ARG FLUX_PHP_BACKPORT_IMAGE=docker-registry.fluxpublisher.ch/flux-php-backport

FROM $FLUX_PHP_BACKPORT_IMAGE AS build

COPY . /flux-ilias-rest-helper-plugin

RUN php-backport /flux-ilias-rest-helper-plugin

FROM scratch

LABEL org.opencontainers.image.source="https://github.com/flux-caps/flux-ilias-rest-helper-plugin"
LABEL maintainer="fluxlabs <support@fluxlabs.ch> (https://fluxlabs.ch)"
LABEL flux-docker-registry-rest-api-build-path="/flux-ilias-rest-helper-plugin"

COPY --from=build /flux-ilias-rest-helper-plugin /flux-ilias-rest-helper-plugin

ARG COMMIT_SHA
LABEL org.opencontainers.image.revision="$COMMIT_SHA"
