<?php

namespace CMS\Administrator\Functions\Load;

class Template {

    protected $container;
    protected $db;
    protected $modules;

    public function __construct($modules, $container) {
        $this->container = $container;
        $this->db = $container->system_connexion->database();
        $this->modules = $modules;
    }

    public function render() {
		include('../config.php');
		$header = new \CMS\Administrator\Functions\Load\Head($this->modules, $this->container);
		$plugins = $header->available_plugins();
		$scripts = $header->render_scripts();
		$inits = $header->render_init();
		$head = '';
		
		foreach($scripts as $script){
			$head .= file_get_contents($script);
		}
		
		foreach($inits as $init){
			$head .= file_get_contents($init);
		}
		
        $al_info_admin = $this->modules;
        $al_title_template = $this->container->system_template->loadfileinfo();
        $al_title_page = $this->container->system_config->loadtitle_admin();
        $al_site_title = $this->container->system_config->loadvariable();
        return include('../Templates/' . $al_title_template . '/index.php');
    }

}

?>