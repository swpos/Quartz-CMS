<?php

namespace CMS\Libraries\Classes\Container;

class View {

    protected $template = null;
    protected $data = array();
    protected $container = null;
    public $v;
    public $side;

    public function __construct($container) {
		$this->container = $container;
		$this->v = $this->container->variables;
	}

	public function init($module = null, $template = null){
		/********* GET SIDE **************/
		$dir =  dirname($_SERVER['PHP_SELF']);
		$dirs = explode('/', $dir);
		$side = strtolower($dirs[1]);
		$this->side = $side;
		
		if($side == 'administrator'){
			/*******ADMIN*********************************************************************/
			if (file_exists('../Templates/admin/html/' . $module . '/' . $template . '.php')) {
				$file = '../Templates/admin/html/' . $module . '/' . $template . '.php';
			} else {
				$file = 'Modules/' . $module . '/Views/' . $template . '.php';
			}
		} else {
			/*******SITE*********************************************************************/
			$system_template = $this->container->system_template;

			if (file_exists('Templates/' . $system_template->loaddefaulttemplate() . '/html/' . $module . '/' . $template . '.php')) {
				$file = 'Templates/' . $system_template->loaddefaulttemplate() . '/html/' . $module . '/' . $template . '.php';
			} else {
				$file = 'Modules/' . $module . '/Views/' . $template . '.php';
			}
		}

		if (file_exists($file) && !empty($template)) {
			$this->template = $file;
		} else {
			die($file . ' not found!');
		}
		
		$this->assign_default('v', $this->container->variables);
        $this->assign_default('system_pagination', $this->container->system_pagination);
        $this->assign_default('system_shortcut', $this->container->system_shortcut);
        $this->assign_default('system_skeleton', $this->container->system_skeleton);
        $this->assign_default('system_template', $this->container->system_template);
	    
		if($this->side == 'administrator') {
			$this->assign_default('top_menu', $this->container->system_config->buildMenu());
			$this->assign_default('error', $this->v->d($_SESSION['error_message']));
		}
	}

    public function assign($variable, $value) {
        $not_permitted = array(
			'v',
            'system_pagination',
            'system_shortcut',
            'system_skeleton',
            'system_template',
			'top_menu',
			'error'
        );
        if (!in_array($variable, $not_permitted)) {
			$this->data[$variable] = $this->convert($value, $this->side);
        }
    }

    public function assign_default($variable, $value) {
        $this->data[$variable] = $value;
    }
	
	public function convert($data, $side) {
		if (is_array($data)) {
			foreach ( $data as $key => $value ) {
				$data[$key] = $this->convert($value, $side);
			}
		} else if (is_object($data)) {
			foreach ( $data as $key => $value ) {
				$data->$key = $this->convert($value, $side);
			}
		} else {
			if($side == "administrator"){
				if($data == strip_tags($data)){
					$data = htmlspecialchars(stripslashes($data), ENT_QUOTES);
				}
			} else {
				$data = stripslashes($data);
			}
		}
		return $data;
	}
	
    public function render() {
        extract($this->data);
        mb_internal_encoding('UTF-8');
		mb_http_output('UTF-8');
		mb_http_input('UTF-8');
		mb_language('uni');
		mb_regex_encoding('UTF-8');
		ob_start('mb_output_handler');
		header('Content-type: text/html; charset=utf-8');
        include( $this->template);
        $content = ob_get_contents();
        ob_end_clean();
		
		$_SESSION['return'] = 'render';
        return $content;
    }

}

?>