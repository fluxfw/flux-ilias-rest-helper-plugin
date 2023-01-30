FROM php:8.2-cli-alpine AS build

RUN (mkdir -p /flux-php-backport && cd /flux-php-backport && wget -O - https://github.com/fluxfw/flux-php-backport/archive/refs/tags/v2023-01-30-1.tar.gz | tar -xz --strip-components=1)

COPY . /build/flux-ilias-rest-helper-plugin

RUN /flux-php-backport/bin/php-backport.php /build/flux-ilias-rest-helper-plugin

FROM scratch

COPY --from=build /build /
