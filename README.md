# flux-ilias-rest-helper-plugin

ILIAS Rest Helper Plugin

## Installation

In [flux-ilias](https://github.com/flux-caps/flux-ilias)

```dockerfile
COPY --from=docker-registry.fluxpublisher.ch/flux-ilias-api/rest-helper-plugin:latest /flux-ilias-rest-helper-plugin $ILIAS_WEB_DIR/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/flux_ilias_rest_helper_plugin
```

### Api

You need the [flux-ilias-rest-api](https://github.com/flux-caps/flux-ilias-rest-api)

### Cron

For ILIAS < 8 you need to install [flux-ilias-rest-legacy-cron-helper-plugin](https://github.com/flux-caps/flux-ilias-rest-legacy-cron-helper-plugin) too
