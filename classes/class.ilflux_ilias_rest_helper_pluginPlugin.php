<?php

use FluxIliasRestApi\Adapter\Api\IliasRestApi;

trait FluxIliasRestHelperPlugin
{

    private IliasRestApi $ilias_rest_api;


    public function getPluginName() : string
    {
        return "flux_ilias_rest_helper_plugin";
    }


    public function handleEvent(/*string*/ $component, /*string*/ $event, /*array*/ $parameters) : void
    {
        $this->ilias_rest_api->handleIliasEvent(
            $component,
            $event,
            $parameters
        );
    }


    protected function beforeUninstall() : bool
    {
        $this->ilias_rest_api->uninstallHelperPlugin();

        return true;
    }


    protected function beforeUpdate() : bool
    {
        $this->ilias_rest_api->installHelperPlugin();

        return true;
    }


    protected function init() : void
    {
        require_once __DIR__ . "/../autoload.php";

        $this->ilias_rest_api = IliasRestApi::new();
    }
}

if (interface_exists(ilCronJobProvider::class)) {
    class ilflux_ilias_rest_helper_pluginPlugin extends ilUserInterfaceHookPlugin implements ilCronJobProvider
    {

        use FluxIliasRestHelperPlugin;

        public function getCronJobInstance(string $jobId) : ilCronJob
        {
            return $this->ilias_rest_api->getCronJob(
                $jobId
            );
        }


        public function getCronJobInstances() : array
        {
            return $this->ilias_rest_api->getCronJobs();
        }
    }
} else {
    class ilflux_ilias_rest_helper_pluginPlugin extends ilUserInterfaceHookPlugin
    {

        use FluxIliasRestHelperPlugin;
    }
}
