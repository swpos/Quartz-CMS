<?php
	function load_gallery ($al_connexion, $al_id_module, $al_shortcut, $al_modules){
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_modules WHERE id = :al_id_module");
		$select1->bindParam(':al_id_module', $al_id_module);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_modules = $select1->fetch();
		
		return render(array('al_connexion' => $al_connexion, 'al_fetch_modules' => $al_fetch_modules, 'al_modules' => $al_modules, 'al_id_module' => $al_id_module), 'gallery', 'gallery');
	}
	
?>