<?php

namespace CMS\Libraries\Classes\Extended;

use CMS\Libraries\Classes\Standard as Standard;

class Model extends Standard {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function init($module = null, $file = null) {
		
		if(SIDE == '/Administrator'){
			$side = "\Administrator";
		} else {
			$side = "";
		}
		
		$path = array_slice(explode('/', dirname(__FILE__)), 0, -3);
		$file_content = implode('/', $path).SIDE.'/Modules/' . ucfirst($module) . '/Models/' . ucfirst($file) . '.php';
		
		if (file_exists($file_content)) {
           $_SESSION['modal_type'] = '\CMS'.$side.'\Modules\\' . ucfirst($module) . '\Models\\' . ucfirst($file);
		} else {
			$_SESSION['modal_type'] = '';
            die($file_content . ' not found');
        }
		
		$template = $_SESSION['modal_type'];
		$model = new $template($this->container);
		
		return $model;
	}

    /*public function render($action = null, $array) {
		$template = $_SESSION['modal_type'];
		$function = $action;
		$model = new $template($this->container);
		
		return $model->$function($array);
    }*/

}

?>