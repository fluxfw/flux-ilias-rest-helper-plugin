FROM scratch

LABEL org.opencontainers.image.source="https://github.com/flux-eco/flux-ilias-rest-helper-plugin"
LABEL maintainer="fluxlabs <support@fluxlabs.ch> (https://fluxlabs.ch)"

COPY . /flux-ilias-rest-helper-plugin
