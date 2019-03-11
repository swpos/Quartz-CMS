<?php

namespace CMS\Functions\Load;

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
		if(!empty($this->modules)){
			foreach ($this->modules as $al_values) {
				if(!empty($al_values)){
					foreach ($al_values as $al_position => $al_content) {
						$al_position1 = explode('-', $al_position);
		
						if (!isset(${$al_position1[1]})) {
							${$al_position1[1]} = '';
						}
						${$al_position1[1]} .= $al_content;
					}
				}
			}
		}
		
		include('config.php');
		$header = new \CMS\Functions\Load\Head($this->modules, $this->container);
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
		

        $al_site_title = $this->container->system_config->loadvariable();
		
		$page = isset($_GET['page']) ? $_GET['page'] : "index";        
        $al_title_page = $this->container->system_config->loadtitle_site($page);
        $templatetitle = $this->container->system_template->loadtemplatetitle();
        $al_title_template = $templatetitle;
        return include('Templates/' . $templatetitle . '/index.php');
    }

}

?>