<?php

use ILIAS\HTTP\Wrapper\SuperGlobalDropInReplacement;
use ILIAS\Refinery\KeyValueAccess;

/**
 * @property ilflux_ilias_rest_helper_pluginPlugin $plugin_object
 */
class ilflux_ilias_rest_helper_pluginUIHookGUI extends ilUIHookPluginGUI
{

    public function getHTML(/*string*/ $a_comp, /*string*/ $a_part, /*array*/ $a_par = []) : array
    {
        if ($a_comp === "Services/Utilities" && $a_part === "redirect") {
            $this->fixSuperGlobalDropInReplacements();

            $url = $this->plugin_object::getIliasRestApi()
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
        $this->fixSuperGlobalDropInReplacements();

        $this->plugin_object::getIliasRestApi()
            ->handleIliasGoto();
    }


    private function fixSuperGlobalDropInReplacements() : void {
        if (!class_exists(SuperGlobalDropInReplacement::class)) {
            return;
        }

        $this->fixSuperGlobalDropInReplacement(
            "_GET"
        );
        $this->fixSuperGlobalDropInReplacement(
            "_POST"
        );
        $this->fixSuperGlobalDropInReplacement(
            "_COOKIE"
        );
    }


    private function fixSuperGlobalDropInReplacement(string $name) : void {
        if (is_array($GLOBALS[$name]) || !($GLOBALS[$name] instanceof SuperGlobalDropInReplacement)) {
            return;
        }

        $GLOBALS[$name] = Closure::bind(function() : array {
            return $this->raw_values;
        }, $GLOBALS[$name], KeyValueAccess::class)();
    }
}
