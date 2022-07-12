FROM php:cli-alpine AS build

RUN (mkdir -p /flux-php-backport && cd /flux-php-backport && wget -O - https://github.com/flux-eco/flux-php-backport/releases/download/v2022-07-12-1/flux-php-backport-v2022-07-12-1-build.tar.gz | tar -xz --strip-components=1)

COPY . /build/flux-ilias-rest-helper-plugin

RUN /flux-php-backport/bin/php-backport.php /build/flux-ilias-rest-helper-plugin FluxIliasRestApi\\Libs\\FluxLegacyEnum

FROM scratch

COPY --from=build /build /
