# flux-ilias-rest-helper-plugin

ILIAS Rest Helper Plugin

## Installation

Hint: Use `latest` as `%tag%` (or omit it) for get the latest build

### flux-ilias-rest-helper-plugin

```dockerfile
COPY --from=docker-registry.fluxpublisher.ch/flux-ilias-rest-helper-plugin:%tag% /flux-ilias-rest-helper-plugin %web_root%/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/flux_ilias_rest_helper_plugin
```

or

```dockerfile
RUN (mkdir -p %web_root%/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/flux_ilias_rest_helper_plugin && cd %web_root%/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/flux_ilias_rest_helper_plugin && wget -O - https://docker-registry.fluxpublisher.ch/api/get-build-archive/flux-ilias-rest-helper-plugin.tar.gz?tag=%tag% | tar -xz --strip-components=1)
```

or

Download https://docker-registry.fluxpublisher.ch/api/get-build-archive/flux-ilias-rest-helper-plugin.tar.gz?tag=%tag% and extract it to `%web_root%/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/flux_ilias_rest_helper_plugin`

Hint: If you use `wget` without pipe use `--content-disposition` to get the correct file name

### Api

You need the [flux-ilias-rest-api](https://github.com/flux-caps/flux-ilias-rest-api)

### Cron

For ILIAS < 8 you need to install [flux-ilias-rest-legacy-cron-helper-plugin](https://github.com/flux-caps/flux-ilias-rest-legacy-cron-helper-plugin) too
