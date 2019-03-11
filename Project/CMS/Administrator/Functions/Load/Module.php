<?php

namespace CMS\Administrator\Functions\Load;

class Module {
	public $db;
    public $container;
    public $system_editor;
    public $system_validation;
    public $system_config;
    public $system_pagination;
    public $system_repopulate;
    public $system_shortcut;
    public $system_skeleton;
    public $system_template;
    public $system_model;
    public $system_view;
    public $system_form;
    public $data;
    public $v;
    public $class_name;
    public $add_module_fields;
    public $edit_module_fields;
    public $add_module_update_fields;
    public $edit_module_update_fields;
	
    public function __construct($container) {
        $this->container = $container;
        $this->db = $container->system_connexion->database();
        $this->system_editor = $container->system_editor;
        $this->system_validation = $container->system_validation;
        $this->system_config = $container->system_config;
        $this->system_pagination = $container->system_pagination;
        $this->system_repopulate = $container->system_repopulate;
        $this->system_shortcut = $container->system_shortcut;
        $this->system_skeleton = $container->system_skeleton;
        $this->system_template = $container->system_template;
        $this->system_model = $container->system_model;
        $this->system_view = $container->system_view;
        $this->system_form = $container->system_form;
        $this->data = $container->data;
        $this->v = $container->variables;
        $this->class_name = strtolower($this->v->_g('page'));
		$this->add_module_fields = ['title','modules','shortcut','position','order1','date','time','published'];
		$this->edit_module_fields = ['title','category','modules','date','time','order1','shortcut','position','published','username'];
		$this->add_module_update_fields = ['title','category','modules','shortcut','position','published','order1','date','time','username'];
		$this->edit_module_update_fields = ['title','category','modules','shortcut','position','published','date','time','order1','username'];
    }

    public function load_modules() {
        $content_final = '';
        $page = $this->v->_g('page');
        $action = $this->v->_g('action');
        $id =  $this->v->_g('id');
		$pseudom = $this->v->_s('pseudom');
        $lang = $this->v->_s('lang');
		$_SESSION['return'] = 'back';
	  
        $this->container->system_languages->loadlangfilesite($lang, 'admin');
        $this->container->system_languages->loadlangfileplugin($page, $lang, 'admin');

        $class_name_final = "\CMS\Administrator\Modules\\" . $page . "\\" . $page;

        $content = new $class_name_final($this->container);
        $content_final = $content->$action();
		
		if($_SESSION['return'] == 'back'){
			header('Location: ' . $_SERVER['HTTP_REFERER']);
    	    exit;
		}

        return $content_final;
    }
	
	
}

?>