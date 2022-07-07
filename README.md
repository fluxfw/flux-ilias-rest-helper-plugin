# flux-ilias-rest-helper-plugin

ILIAS Rest Helper Plugin

## Installation

### flux-ilias-rest-helper-plugin

```dockerfile
COPY --from=docker-registry.fluxpublisher.ch/flux-ilias-rest-helper-plugin:%tag% /flux-ilias-rest-helper-plugin %web_root%/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/flux_ilias_rest_helper_plugin
```

or

```dockerfile
RUN (mkdir -p %web_root%/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/flux_ilias_rest_helper_plugin && cd %web_root%/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/flux_ilias_rest_helper_plugin && wget -O - https://github.com/flux-caps/flux-ilias-rest-helper-plugin/releases/download/%tag%/flux-ilias-rest-helper-plugin-%tag%-build.tar.gz | tar -xz --strip-components=1)
```

or

Download https://github.com/flux-caps/flux-ilias-rest-helper-plugin/releases/download/%tag%/flux-ilias-rest-helper-plugin-%tag%-build.tar.gz and extract it to `%web_root%/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/flux_ilias_rest_helper_plugin`

### Api

You need the [flux-ilias-rest-api](https://github.com/flux-caps/flux-ilias-rest-api)

### Cron

For ILIAS < 8 you need to install [flux-ilias-rest-legacy-cron-helper-plugin](https://github.com/flux-caps/flux-ilias-rest-legacy-cron-helper-plugin) too
