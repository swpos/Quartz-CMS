<?php

namespace CMS\Libraries\Tables;

class Template {

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
				$field = $this->system_validation->$validation($field, 'template', $this->type);
			}
		}
		
		return $field;
	}
	
	public function id($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function title($value, $functions) {
		return $this->do_functions($value, $functions);	
	}
	
	public function description($value, $functions) {
		return $this->do_functions($value, $functions);	
	}
	
	public function date($value, $functions) {
		return $this->do_functions(($value != '' ? $value : date('Y-m-d')), $functions);
	}
	
	public function time($value, $functions) {
		return $this->do_functions(($value != '' ? $value : date('H:i:s')), $functions);
	}
	
	public function active($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function admin($value, $functions) {
		return $this->do_functions('0', $functions);
	}
	
	public function username($value, $functions) {
		return $this->do_functions($this->v->_s('pseudom'), $functions);		
	}
}

?>