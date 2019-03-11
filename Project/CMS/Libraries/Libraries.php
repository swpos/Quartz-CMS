<?php

namespace CMS\Libraries;

class Libraries {

	protected $container;

    public function __construct($container) {
		$this->container = $container;
    }
	
	public function load_standard() {
		$this->container->system_validation = new \CMS\Libraries\Classes\Standard\Validation();
		$this->container->variables = new \CMS\Libraries\Classes\Standard\Variables();
		$this->container->system_editor = new \CMS\Libraries\Classes\Standard\Editor();
		$this->container->system_languages = new \CMS\Libraries\Classes\Standard\Language();
		$this->container->system_pagination = new \CMS\Libraries\Classes\Standard\Pagination();
		$this->container->system_repopulate = new \CMS\Libraries\Classes\Standard\Repopulate();
		$this->container->security = new \CMS\Libraries\Classes\Standard\Security();
		new \CMS\Libraries\Classes\Standard($this->container);
	}
	
	public function load_extended() {
		$standard = $this->container;
		$this->container->system_config = new \CMS\Libraries\Classes\Extended\Config($standard);
		$this->container->system_model = new \CMS\Libraries\Classes\Extended\Model($standard);
		$this->container->system_plugins = new \CMS\Libraries\Classes\Extended\Plugins($standard);
		$this->container->system_shortcut = new \CMS\Libraries\Classes\Extended\Shortcut($standard);
		$this->container->system_skeleton = new \CMS\Libraries\Classes\Extended\Skeleton($standard);
		$this->container->system_template = new \CMS\Libraries\Classes\Extended\Template($standard);
		$this->container->system_form = new \CMS\Libraries\Classes\Extended\Form($standard);
	}
	
	public function load_container() {
		$this->container->system_view = new \CMS\Libraries\Classes\Container\View($this->container);
	}
}

?>