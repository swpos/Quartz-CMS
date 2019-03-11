<?php

namespace CMS\Libraries\Tables;

class Contact {

    protected $db;
	protected $container;
	protected $system_validation;
	protected $v;
	protected $type;

    public function __construct($container, $type) {
        $this->container = $container;
        $this->db = $container->system_connexion->database();
        $this->system_validation = $container->system_validation;
        $this->v = $container->variables;
		$this->type = $type;
    }
	
	public function do_functions($field, $functions) {
		if(!empty($functions)){
			$functions = explode(',', $functions);
			foreach($functions as $validation){
				$field = $this->system_validation->$validation($field, 'contact', $this->type);
			}
		}
		
		return $field;
	}
	
	public function id($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function id_module($value, $functions) {
		return $this->do_functions($value, $functions);	
	}
	
	public function date($value, $functions) {
		return $this->do_functions(($value != '' ? $value : date('Y-m-d')), $functions);
	}
	
	public function time($value, $functions) {
		return $this->do_functions(($value != '' ? $value : date('H:i:s')), $functions);
	}
	
	public function first_name($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function last_name($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function email($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function phone($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function postal_code($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function city($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function states($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function country($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function daybirth($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function monthbirth($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function yearbirth($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function gender($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function content($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function shortcut($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function username($value, $functions) {
		return $this->do_functions($value, $functions);		
	}
}

?>