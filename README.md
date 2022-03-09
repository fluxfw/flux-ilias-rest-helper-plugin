# flux-ilias-rest-helper-plugin

ILIAS Rest Helper Plugin

## Installation

In [flux-ilias](https://github.com/fluxapps/flux-ilias)

```dockerfile
COPY --from=docker-registry.fluxpublisher.ch/flux-ilias-rest/helper-plugin:latest /flux-ilias-rest-helper-plugin "$ILIAS_WEB_DIR/Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/flux_ilias_rest_helper_plugin"
```

### Api

You need the [flux-ilias-rest-api](https://github.com/fluxapps/flux-ilias-rest-api)

If you use `flux-ilias-rest-api` on a different path than `Customizing/global/flux-ilias-rest-api`, you need to set the environment variable `FLUX_ILIAS_REST_HELPER_PLUGIN_API_PATH` in `flux-ilias` (Relative to Customizing/global)

### Cron

For ILIAS < 8 you need to install [flux-ilias-rest-legacy-cron-helper-plugin](https://github.com/fluxapps/flux-ilias-rest-legacy-cron-helper-plugin) too
