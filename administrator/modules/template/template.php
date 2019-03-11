<?php
	function list_template($al_connexion) {
		$al_dir    = '../templates';
		$al_get_folders = scandir($al_dir);
		
		foreach($al_get_folders as $al_key => $al_value){
			if(($al_value!='..') && ($al_value!='.')){
				$select2=$al_connexion->query("SELECT * FROM ".HASH."_template WHERE title='$al_value'");
				$al_num_template = $select2->rowCount();	
				if(empty($al_num_template)){
					$query = $al_connexion->prepare("INSERT INTO ".HASH."_template (title) VALUES(:title)");
					$query->execute(
						array(
							':title'=>$al_value
						)
					);
				}
			}
		}
		
		return render(array('al_connexion' => $al_connexion, 'al_get_folders' => $al_get_folders), 'template', 'templates_list');
	}
	
	function post_template($al_connexion) {
		$al_active = encoding((isset($_POST['active']) ? $_POST['active'] : ''));
		$al_description = encoding((isset($_POST['description']) ? $_POST['description'] : ''));
		$al_array=explode('-',$al_active);		
		$date=date('Y-m-d');
		$time=date('H:i:s');
		$update_template = $al_connexion->prepare("UPDATE ".HASH."_template SET active=?");
		$update_template->execute(array('0'));
		$update_template = $al_connexion->prepare("UPDATE ".HASH."_template SET active=? WHERE title=?");
		$update_template->execute(array('1','admin'));
		$update_template = $al_connexion->prepare("UPDATE ".HASH."_template SET active=? WHERE id=?");
		$update_template->execute(array($al_array[0],$al_array[1]));
		
		foreach($al_description as $key => $value){
			$update_template = $al_connexion->prepare("UPDATE ".HASH."_template SET description=? WHERE id=?");
			$update_template->execute(array($value,$key));
		}
		$update_template = $al_connexion->prepare("UPDATE ".HASH."_template SET time=?,date=? WHERE id=?");
		$update_template->execute(array($time,$date,$al_array[1]));
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
	
?>