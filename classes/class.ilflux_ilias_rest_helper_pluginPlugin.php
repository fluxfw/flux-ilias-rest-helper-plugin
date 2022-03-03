<?php

use FluxIliasRestApi\Adapter\Api\Api;

trait FluxIliasRestHelperPlugin
{

    private Api $api;


    public function getPluginName() : string
    {
        return "flux_ilias_rest_helper_plugin";
    }


    public function handleEvent(/*string*/ $component, /*string*/ $event, /*array*/ $parameters) : void
    {
        $this->api->handleIliasEvent(
            $component,
            $event,
            $parameters
        );
    }


    protected function beforeUninstall() : bool
    {
        $this->api->uninstallHelperPlugin();

        return true;
    }


    protected function beforeUpdate() : bool
    {
        $this->api->installHelperPlugin();

        return true;
    }


    protected function init() : void
    {
        require_once __DIR__ . "/../autoload.php";

        $this->api = Api::new();
    }
}

if (interface_exists(ilCronJobProvider::class)) {
    class ilflux_ilias_rest_helper_pluginPlugin extends ilUserInterfaceHookPlugin implements ilCronJobProvider
    {

        use FluxIliasRestHelperPlugin;

        public function getCronJobInstance(string $jobId) : ilCronJob
        {
            return $this->api->getCronJob(
                $jobId
            );
        }


        public function getCronJobInstances() : array
        {
            return $this->api->getCronJobs();
        }
    }
} else {
    class ilflux_ilias_rest_helper_pluginPlugin extends ilUserInterfaceHookPlugin
    {

        use FluxIliasRestHelperPlugin;
    }
}
