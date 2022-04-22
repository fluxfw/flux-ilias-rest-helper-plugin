FROM scratch

LABEL org.opencontainers.image.source="https://github.com/flux-caps/flux-ilias-rest-helper-plugin"
LABEL maintainer="fluxlabs <support@fluxlabs.ch> (https://fluxlabs.ch)"

COPY . /flux-ilias-rest-helper-plugin

ARG COMMIT_SHA
LABEL org.opencontainers.image.revision="$COMMIT_SHA"
