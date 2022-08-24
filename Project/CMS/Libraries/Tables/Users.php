<?php

namespace CMS\Libraries\Tables;

class Users {

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
				$field = $this->system_validation->$validation($field, 'users', $this->type);
			}
		}
		
		return $field;
	}
	
	public function id($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function idm($value, $functions) {
		return $this->do_functions($value, $functions);	
	}
	
	public function username($value, $functions) {
		return $this->do_functions($value, $functions);	
	}
	
	public function password($value, $functions) {
		return $this->do_functions(md5($value), $functions);	
	}
	
	public function email($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function picture($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function role($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function gender($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function ip($value, $functions) {
		return $this->do_functions($_SERVER['REMOTE_ADDR'], $functions);
	}
	
	public function city($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function first_name($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function last_name($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function age($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function about($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function articles($value, $functions) {
		return $this->do_functions('0', $functions);
	}
	
	public function country($value, $functions) {
		return $this->do_functions($value, $functions);
	}
	
	public function blocked($value, $functions) {
		return $this->do_functions('0', $functions);
	}
}

?>