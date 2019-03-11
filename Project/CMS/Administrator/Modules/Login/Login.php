<?php

namespace CMS\Administrator\Modules\Login;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Login extends ModuleExtended {
	
    public function __construct($container) {
		parent::__construct($container);
    }
	
    public function login_connexion() {
		$loadconfig = $this->system_config->loadconfig();
		$regis_link = $loadconfig->regis_link;
        $this->system_view->init('Login', 'Connexion');
		$this->system_view->assign('regis_link', $regis_link);
        return $this->system_view->render();
    }

    public function login_connexion_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		        
		$info = [
			'al_pseudo_membre' => $post['username'],
			'al_passe_membre' => md5($post['password'])
		];

		$connexion = $this->system_model->init("Login", "Connexion");
		$verif = $connexion->countUsers($info);
		
		$_SESSION['error_message'] = '';
		
        if ($verif == 0) {
            $_SESSION['error_message'] .= LOGIN_USER_DOES_NOT_EXIST;
        }
		
		$row = $connexion->getUser($info);
        $block = $row->blocked;
		
        if ($block == "1") {
        	$_SESSION['error_message'] .= LOGIN_SORRY_CANT_LOG_IN;
        }
		
        if (empty($_SESSION['error_message'])) {
			$info = [
				'data' => ['ip' => $_SERVER['REMOTE_ADDR']],
				'where' => ['password' => md5($post['password'])]
			];
			
			$edit = $this->system_model->init("User", "Edit");
			$edit->userUpdate($info);
			
            $_SESSION['pseudom'] = $row->username;
        }
        header('Location: index.php?page=Panel&action=panel');
        exit;
    }

    public function login_disconnect() {
		$lang = $session['lang'];
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['lang'] = $lang;
        header('Location: index.php');
        exit;
    }
}

?>