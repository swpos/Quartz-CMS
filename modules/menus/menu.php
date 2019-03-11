<?php
	function load_menu ($al_connexion, $al_id_module, $al_modules, $al_shortcut){
		$select1=$al_connexion->query("SELECT * FROM ".HASH."_section_name WHERE id_module='$al_id_module'");
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_section_name = $select1->fetch();
		$al_id_menu=$al_fetch_section_name->id;
		
		$select2=$al_connexion->query("SELECT * FROM ".HASH."_link_menu WHERE id_index='$al_id_menu' ORDER BY order1");
		$select2->setFetchMode(PDO::FETCH_OBJ);
		
		return render(array('al_connexion' => $al_connexion, 'al_shortcut' => $al_shortcut, 'al_modules' => $al_modules, 'al_fetch_section_name' => $al_fetch_section_name, 'select2' => $select2), 'menus', 'menu');
	}
?>