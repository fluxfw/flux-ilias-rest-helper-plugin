<?php

use FluxIliasRestApi\Libs\FluxIliasApi\Adapter\Api\IliasApi;

class ilflux_ilias_rest_helper_pluginUIHookGUI extends ilUIHookPluginGUI
{

    private IliasApi $ilias_api;


    private function __construct(
        /*private readonly*/ IliasApi $ilias_api
    ) {
        $this->ilias_api = $ilias_api;
    }


    public static function new(
        IliasApi $ilias_api
    ) : /*static*/ self
    {
        return new static(
            $ilias_api
        );
    }


    public function getHTML(/*string*/ $a_comp, /*string*/ $a_part, $a_par = []) : array
    {
        if ($a_comp === "Services/Utilities" && $a_part === "redirect") {
            $url = $this->ilias_api->handleIliasRedirect(
                $a_par["html"]
            );
            if ($url !== null) {
                return [
                    "mode" => static::REPLACE,
                    "html" => $url
                ];
            }
        }

        return parent::getHTML($a_comp, $a_part, $a_par);
    }


    public function gotoHook() : void
    {
        $this->ilias_api->handleIliasGoto();
    }
}
