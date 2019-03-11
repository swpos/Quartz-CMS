<?php

namespace CMS\Libraries\Tables;

class Linkmenu {

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
				$field = $this->system_validation->$validation($field, 'linkmenu', $this->type);
			}
		}
		
		return $field;
	}
	
	public function id($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function id_index($value, $functions) {
		return $this->do_functions($value, $functions);	
	}
	
	public function name($value, $functions) {
		return $this->do_functions($value, $functions);	
	}
	
	public function shortcut($value, $functions) {
		return $this->do_functions($value, $functions);	
	}
	
	public function order1($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function published($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function sub_menu($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function username($value, $functions) {
		return $this->do_functions($this->v->_s('pseudom'), $functions);		
	}
}

?>