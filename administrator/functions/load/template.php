<?php
	function load_modules($al_connexion, $al_shortcut, $al_id, $al_action){
			if($al_shortcut=='0'){
				$al_shortcut='index';
			}
			
			if($al_shortcut=='index' && !isset($_SESSION['pseudom'])){
				$al_shortcut='connexion';
			}
			
			$al_get_info='';
			
			if($al_action != '0'){	
				$function_name=$al_action."_".$al_shortcut;
				$al_get_info=$function_name($al_connexion);
				if(empty($al_get_info)){
					header("Location: ".$_SERVER['HTTP_REFERER']);
				}
			}
			else {			
				if($al_shortcut){	
					$al_get_info=$al_shortcut($al_connexion);
				}
			}
		return $al_get_info;	
	}

	function load_template ($al_connexion, $al_site_title, $al_get_info, $al_title_page){
		$al_info_admin = $al_get_info;
		$al_title_template=loadfileinfo($al_connexion);
		$al_site_title = loadvariable($al_connexion);
		include('../templates/'.$al_title_template.'/index.php');
	}
?>