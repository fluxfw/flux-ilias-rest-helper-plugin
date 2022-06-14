<?php

/**
 * @property ilflux_ilias_rest_helper_pluginPlugin $plugin_object
 */
class ilflux_ilias_rest_helper_pluginUIHookGUI extends ilUIHookPluginGUI
{

    public function getHTML(/*string*/ $a_comp, /*string*/ $a_part, $a_par = []) : array
    {
        if ($a_comp === "Services/Utilities" && $a_part === "redirect") {
            $url = $this->plugin_object::getIliasApi()
                ->handleIliasRedirect(
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
        $this->plugin_object::getIliasApi()
            ->handleIliasGoto();
    }
}
