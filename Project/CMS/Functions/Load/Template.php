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
		$page = isset($_GET['page']) ? $_GET['page'] : "index";        
		$action = isset($_GET['action']) ? $_GET['action'] : "index"; 
		$header = new \CMS\Functions\Load\Head($this->modules, $this->container);
		$head_plugins = $header->available_plugins();
		$head_scripts = $header->render_scripts();
		$head_inits = $header->render_init();
		$head = '';
		
		foreach($head_scripts as $script){
			$head .= file_get_contents($script);
		}
		
		foreach($head_inits as $init){
			$head .= file_get_contents($init);
		}
		
		$footer = new \CMS\Functions\Load\Body($this->modules, $this->container);
		$body_plugins = $footer->available_plugins();
		$body_scripts = $footer->render_scripts();
		$body_inits = $footer->render_init();
		$body = '';
		
		foreach($body_scripts as $script){
			$body .= file_get_contents($script);
		}
		
		foreach($body_inits as $init){
			$body .= file_get_contents($init);
		}

        $al_site_title = $this->container->system_config->loadvariable();       
        $al_title_page = $this->container->system_config->loadtitle_site($page);
        $templatetitle = $this->container->system_template->loadtemplatetitle();
        $al_title_template = $templatetitle;
        return include('Templates/' . $templatetitle . '/index.php');
    }

}

?>