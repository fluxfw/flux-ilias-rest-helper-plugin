<?php

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;

trait FluxIliasRestHelperPlugin
{

    private static IliasApi $ilias_api;


    public function __construct(...$args)
    {
        parent::__construct(...$args);

        $this->provider_collection->setMainBarProvider(static::getIliasApi()
            ->getMenuProvider(
                $this
            ));
    }


    public static function getIliasApi() : IliasApi
    {
        require_once __DIR__ . "/../autoload.php";

        static::$ilias_api ??= IliasApi::new();

        return static::$ilias_api;
    }


    public function getPluginName() : string
    {
        return "flux_ilias_rest_helper_plugin";
    }


    public function handleEvent(/*string*/ $component, /*string*/ $event, /*array*/ $parameters) : void
    {
        static::getIliasApi()
            ->handleIliasEvent(
                $component,
                $event,
                $parameters
            );
    }


    protected function beforeUninstall() : bool
    {
        static::getIliasApi()
            ->uninstallHelperPlugin();

        return true;
    }


    protected function beforeUpdate() : bool
    {
        static::getIliasApi()
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
            return static::getIliasApi()
                ->getCronJob(
                    $jobId
                );
        }


        public function getCronJobInstances() : array
        {
            return static::getIliasApi()
                ->getCronJobs();
        }
    }
} else {
    class ilflux_ilias_rest_helper_pluginPlugin extends ilUserInterfaceHookPlugin
    {

        use FluxIliasRestHelperPlugin;
    }
}
