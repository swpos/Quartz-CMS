<?php

function add_position ($al_connexion){
	include('../templates/'.loaddefaulttemplate($al_connexion).'/information.php');
	
	$content = '<select class="chosen-select form-control" name="position">';
	foreach ($al_position as $al_values){
		$content .= '<option value="'.$al_values.'">'.$al_values.'</option>';
	}
	$content .= '</select>';
	return $content;
}

function modify_position ($al_connexion, $al_position_module){
	include('../templates/'.loaddefaulttemplate($al_connexion).'/information.php');
	
	$content = '<select class="chosen-select form-control" name="position">';
	foreach ($al_position as $al_values){
		if($al_values == $al_position_module){
			$content .= '<option value="'.$al_values.'" selected="selected">'.$al_values.'</option>';
		} else {
			$content .= '<option value="'.$al_values.'">'.$al_values.'</option>';
		}
	}
	$content .= '</select>';
	return $content;
}

function add_shortcut ($al_connexion){
	$content = '<ul>';
	$content .= '<li><input type="checkbox" id="select_all" /> Check all/Uncheck all</li>';
	$select2=$al_connexion->query("SELECT * FROM ".HASH."_section_name");
	$select2->setFetchMode(PDO::FETCH_OBJ);
	while($al_fetch_section_name = $select2->fetch()){ 
		$al_id=decoding($al_fetch_section_name->id);
		$al_section=decoding($al_fetch_section_name->section);
		$content .= '<li style="float:left; margin:20px;">'. $al_section;
		$content .= '<ul style="padding:0px; margin:0px; list-style-type:none;">';	
		$select3=$al_connexion->query("SELECT * FROM ".HASH."_link_menu WHERE id_index='".$al_id."'");
		$select3->setFetchMode(PDO::FETCH_OBJ);
	
		while($al_fetch_link_menu = $select3->fetch()){
			$al_name=decoding($al_fetch_link_menu->name);
			$al_shortcut_unique=decoding($al_fetch_link_menu->shortcut);
			$content .= '<li><input type="checkbox" name="shortcut[]" value="'.$al_shortcut_unique.'"> '.$al_name.'</li>';
		}
		$content .= '</ul>';
		$content .= '</li>';    	
	}
	$content .= '</ul>';
	return $content;
}

function modify_shortcut ($al_connexion, $al_shortcut_multiple2){
	$content = '<ul>';
	$content .= '<li><input type="checkbox" id="select_all" /> Check all/Uncheck all</li>';
	$select2=$al_connexion->query("SELECT * FROM ".HASH."_section_name");
	$select2->setFetchMode(PDO::FETCH_OBJ);
	while($al_fetch_section_name = $select2->fetch()){ 
		$al_id=decoding($al_fetch_section_name->id);
		$al_section=decoding($al_fetch_section_name->section);
		$content .= '<li style="float:left; margin:20px;">'. $al_section;
		$content .= '<ul style="padding:0px; margin:0px; list-style-type:none;">';	
		$select3=$al_connexion->query("SELECT * FROM ".HASH."_link_menu WHERE id_index='".$al_id."'");
		$select3->setFetchMode(PDO::FETCH_OBJ);
	
		while($al_fetch_link_menu = $select3->fetch()){
			$al_name=decoding($al_fetch_link_menu->name);
			$al_shortcut_unique=decoding($al_fetch_link_menu->shortcut);
			if(in_array($al_shortcut_unique, $al_shortcut_multiple2)){
				$content .= '<li><input type="checkbox" name="shortcut[]" value="'.$al_shortcut_unique.'" checked="checked"> '.$al_name.'</li>';
			} else {
				$content .= '<li><input type="checkbox" name="shortcut[]" value="'.$al_shortcut_unique.'"> '.$al_name.'</li>';
			}
		}
		$content .= '</ul>';
		$content .= '</li>';    	
	}
	$content .= '</ul>';
	return $content;
}

?>