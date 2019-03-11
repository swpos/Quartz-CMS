<?php

namespace CMS\Libraries\Classes;

class Standard {

    protected $db;
	protected $system_validation;
	protected $system_editor;
	protected $system_languages;
	protected $system_pagination;
	protected $system_repopulate;
	protected $data;
	protected $security;
	protected $v;
	protected $container;

    public function __construct($container) {
        $this->db = $container->system_connexion->database();
		
		$this->system_validation = $container->system_validation;
		$this->system_editor = $container->system_editor;
		$this->system_languages = $container->system_languages;
		$this->system_pagination = $container->system_pagination;
		$this->system_repopulate = $container->system_repopulate;
		$this->data = $container->data;
		$this->security = $container->security;
		$this->v = $container->variables;
		
		$this->container = $container;
    }
}

?>