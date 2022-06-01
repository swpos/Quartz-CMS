<?php

namespace CMS\Administrator\Functions\Load;

class Head {

    protected $container;
    protected $db;
    protected $modules;

    public function __construct($modules, $container) {
        $this->container = $container;
        $this->db = $container->system_connexion->database();
        $this->modules = $modules;
    }
	
	public function available_plugins() {
		return $this->container->system_plugins->check_plugin();
	}

    public function render_scripts() {
		$script = array();
		$plugins = $this->available_plugins();
		foreach($plugins as $key => $value) {
			if(file_exists('../Plugins/'.strtolower($value).'/script/head/'.strtolower($value).'.php')){
				$script[] = '../Plugins/'.strtolower($value).'/script/head/'.strtolower($value).'.php';
			}
		}
		
		return $script;
    }
	
	public function render_init() {
		$init = array();
		$plugins = $this->available_plugins();
		foreach($plugins as $key => $value) {
			if(file_exists('../Plugins/'.strtolower($value).'/init/head/'.strtolower($value).'.php')){
				$init[] = '../Plugins/'.strtolower($value).'/init/head/'.strtolower($value).'.php';
			}
		}
		
		return $init;
    }

}

?>