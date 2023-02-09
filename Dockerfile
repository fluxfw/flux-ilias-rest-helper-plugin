FROM php:8.2-cli-alpine AS build

COPY bin/install-libraries.sh /build/flux-ilias-rest-helper-plugin-build/libs/flux-ilias-rest-helper-plugin/bin/install-libraries.sh
RUN /build/flux-ilias-rest-helper-plugin-build/libs/flux-ilias-rest-helper-plugin/bin/install-libraries.sh

COPY . /build/flux-ilias-rest-helper-plugin-build/libs/flux-ilias-rest-helper-plugin

RUN /build/flux-ilias-rest-helper-plugin-build/libs/flux-ilias-rest-helper-plugin/bin/php-backport.sh

RUN cp -L -R /build/flux-ilias-rest-helper-plugin-build/libs/flux-ilias-rest-helper-plugin /build/flux-ilias-rest-helper-plugin && rm -rf /build/flux-ilias-rest-helper-plugin/bin && rm -rf /build/flux-ilias-rest-helper-plugin-build

RUN (cd /build && tar -czf build.tar.gz flux-ilias-rest-helper-plugin && rm -rf flux-ilias-rest-helper-plugin)

FROM scratch

COPY --from=build /build /
