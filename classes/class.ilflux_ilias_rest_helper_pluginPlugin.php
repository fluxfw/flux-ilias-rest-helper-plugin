<?php

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;

trait FluxIliasRestHelperPlugin
{

    private IliasApi $ilias_api;


    public function getPluginName() : string
    {
        return "flux_ilias_rest_helper_plugin";
    }


    public function handleEvent(/*string*/ $component, /*string*/ $event, /*array*/ $parameters) : void
    {
        $this->ilias_api->handleIliasEvent(
            $component,
            $event,
            $parameters
        );
    }


    protected function beforeUninstall() : bool
    {
        $this->ilias_api->uninstallHelperPlugin();

        return true;
    }


    protected function beforeUpdate() : bool
    {
        $this->ilias_api->installHelperPlugin();

        return true;
    }


    protected function init() : void
    {
        require_once __DIR__ . "/../autoload.php";

        $this->ilias_api = IliasApi::new();
    }
}

if (interface_exists(ilCronJobProvider::class)) {
    class ilflux_ilias_rest_helper_pluginPlugin extends ilUserInterfaceHookPlugin implements ilCronJobProvider
    {

        use FluxIliasRestHelperPlugin;

        public function getCronJobInstance(string $jobId) : ilCronJob
        {
            return $this->ilias_api->getCronJob(
                $jobId
            );
        }


        public function getCronJobInstances() : array
        {
            return $this->ilias_api->getCronJobs();
        }
    }
} else {
    class ilflux_ilias_rest_helper_pluginPlugin extends ilUserInterfaceHookPlugin
    {

        use FluxIliasRestHelperPlugin;
    }
}
