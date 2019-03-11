<?php

namespace CMS\Libraries\Classes\Standard;

class Security {

	public function security_admin($config) {
		$_GET['page'] = isset($_GET['page']) ? $_GET['page'] : "Panel";
		$_GET['action'] = isset($_GET['action']) ? $_GET['action'] : "panel";
		
		if (!empty($_SESSION['pseudom'])) {
			$forbidden_page = explode(',', $config->forbidden_pages);
			$forbidden_action = explode(',', $config->forbidden_actions);
			$except_admin = explode(',', $config->except_admin);
			
			if(
				(
					in_array($_GET['page'], $forbidden_page) || 
					in_array($_GET['action'], $forbidden_action)
				) &&  !in_array($_SESSION['pseudom'], $except_admin)
			){
				header('Location: '. $_SERVER['HTTP_REFERER']);	
			}
		}
		
		if (isset($_GET['page']) && isset($_GET['action'])) {
			$allow_regis = ($config->allow_regis == '1') ? 'user_edit_update' : '';
			$regis_link = ($config->regis_link == '1') ? 'user_add_user' : '';
			if (
				($_GET['page'] != 'Login') && ($_GET['action'] != 'login_connexion_update') && 
				($_GET['action'] != $allow_regis) && ($_GET['action'] != $regis_link)
			) {
				if (empty($_SESSION['pseudom'])) {
					$_GET['page'] = "Login";
					$_GET['action'] = "login_connexion";
				}
			}
		}
    }
}

?>