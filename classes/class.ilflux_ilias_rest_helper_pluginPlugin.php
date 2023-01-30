<?php

use FluxIliasRestApi\Adapter\Api\IliasRestApi;

trait FluxIliasRestHelperPlugin
{

    private static IliasRestApi $ilias_rest_api;


    public function __construct(...$args)
    {
        parent::__construct(...$args);

        $this->provider_collection->setMainBarProvider(static::getIliasRestApi()
            ->getMenuProvider(
                $this
            ));
    }


    public static function getIliasRestApi() : IliasRestApi
    {
        require_once __DIR__ . "/../autoload.php";

        static::$ilias_rest_api ??= IliasRestApi::new();

        return static::$ilias_rest_api;
    }


    public function getPluginName() : string
    {
        return "flux_ilias_rest_helper_plugin";
    }


    public function handleEvent(/*string*/ $component, /*string*/ $event, /*array*/ $parameters) : void
    {
        static::getIliasRestApi()
            ->handleIliasEvent(
                $component,
                $event,
                $parameters
            );
    }


    protected function beforeUninstall() : bool
    {
        static::getIliasRestApi()
            ->uninstallHelperPlugin();

        return true;
    }


    protected function beforeUpdate() : bool
    {
        static::getIliasRestApi()
            ->installHelperPlugin();

        return true;
    }
}

if (interface_exists(ilCronJobProvider::class)) {
    class ilflux_ilias_rest_helper_pluginPlugin extends ilUserInterfaceHookPlugin implements ilCronJobProvider
    {

        use FluxIliasRestHelperPlugin;

        public function getCronJobInstance(string $jobId) : ilCronJob
        {
            return static::getIliasRestApi()
                ->getCronJob(
                    $jobId
                );
        }


        public function getCronJobInstances() : array
        {
            return static::getIliasRestApi()
                ->getCronJobs();
        }
    }
} else {
    class ilflux_ilias_rest_helper_pluginPlugin extends ilUserInterfaceHookPlugin
    {

        use FluxIliasRestHelperPlugin;
    }
}
