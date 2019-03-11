<?php

namespace CMS\Libraries\Classes\Standard;

class Language {
	
    public function loadlangfilesite($lang, $side) {
		if(strtolower($side) == 'admin'){
			$side = "../";
			$folder = "Admin";
		} else {
			$side = "";
			$folder = "Site";
		}
		
		$lang = empty($lang) ? "en" : $lang;

        if (file_exists($side."Languages/".$folder."/" . ucfirst($lang) . "/" . $lang . ".php")) {
            return include $side."Languages/".$folder."/" . ucfirst($lang) . "/" . $lang . ".php";
        }
    }

    public function loadlangfileplugin($plugin, $lang, $side) {
		$lang = empty($lang) ? "en" : $lang;	
		
		if(strtolower($side) == 'admin'){
			$side = "../";
			$folder = "Admin";
		} else {
			$side = "";
			$folder = "Site";
		}
		if (file_exists($side."Languages/".$folder."/" . ucfirst($lang) . "/" . $plugin . ".php") && empty($_SESSION[$folder][$plugin])) {
			$_SESSION[$folder][$plugin] = '1';
			
            return include $side."Languages/".$folder."/" . ucfirst($lang) . "/" . $plugin . ".php";
        }
    }
}

?>