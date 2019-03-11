<?php
	function menu ($al_connexion) {
		$al_id_module = (isset($_GET['id']) ? $_GET['id'] : '');
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_modules WHERE id = :al_id_module");
		$select1->bindParam(':al_id_module', $al_id_module);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_modules = $select1->fetch();
		
		return render(array('al_connexion' => $al_connexion, 'al_fetch_modules' => $al_fetch_modules, 'al_id_module' => $al_id_module), 'menus', 'edit_module');
	}
	
	function menu_list ($al_connexion) {
		return render(array('al_connexion' => $al_connexion), 'menus', 'menu_list');
	}
	
	function add_link ($al_connexion) {
		return render(array('al_connexion' => $al_connexion), 'menus', 'add_link');
	}
	
	function post_add_link($al_connexion){
		$al_section=encoding(explode('-', (isset($_POST['section']) ? $_POST['section'] : '')));
		$al_id=$al_section[0];
		$al_section=$al_section[1];
		$al_name=encoding((isset($_POST['link']) ? $_POST['link'] : ''));
		$al_error = array(
			"Section:input:fill:30" => $al_section
		);
		error_message(true, $al_error);
		
		if(empty($_SESSION['error_message'])){
			foreach($al_name as $al_value){
				if($al_value && (substr_count_array($al_value,$al_name) == 1)){
					$al_shortcut=format_link($al_value);
					$select1 = $al_connexion->prepare("SELECT COUNT(*) FROM  ".HASH."_link_menu WHERE shortcut = :al_shortcut");
					$select1->bindParam(':al_shortcut', $al_shortcut);
					$select1->execute(); 
					$number_of_rows = $select1->fetchColumn();
					if($number_of_rows > 1){
						$al_shortcut=substr(md5($al_value.rand(0,10000000000)), 0, 6);
					}
					
					$query = $al_connexion->prepare("INSERT INTO ".HASH."_link_menu(id_index, name, order1, published, sub_menu, shortcut) VALUES(:id_index, :name, :order1, :published, :sub_menu, :shortcut)");
					$query->execute(
						array(
						':id_index'=>$al_id,
						':name'=>$al_value,
						':order1'=> '0',
						':published'=> '1',
						':sub_menu'=> '0',
						':shortcut'=>$al_shortcut
						)
					);
				}
			}
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}
	
	function link_menu ($al_connexion) {
		$al_id_module = (isset($_GET['id']) ? $_GET['id'] : '');
		$al_id_link=decoding((isset($_GET['id_link']) ? $_GET['id_link'] : ''));
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_link_menu WHERE id = :al_id_link");
		$select1->bindParam(':al_id_link', $al_id_link);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_link_menu = $select1->fetch();
		
		$select2=$al_connexion->prepare("SELECT * FROM ".HASH."_section_name WHERE id_module = :al_id_module");
		$select2->bindParam(':al_id_module', $al_id_module);
		$select2->execute();
		$select2->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_section_name = $select2->fetch();
		
		return render(array('al_connexion' => $al_connexion, 'al_fetch_link_menu' => $al_fetch_link_menu, 'al_fetch_section_name' => $al_fetch_section_name), 'menus', 'edit_link_menu');
	}
	
	function post_menu_menu ($al_connexion) {
		$al_id_menu=(isset($_GET['id']) ? $_GET['id'] : '');
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_position = encoding((isset($_POST['position']) ? $_POST['position'] : ''));
		$al_id = encoding((isset($_POST['id']) ? $_POST['id'] : ''));
		$al_category = encoding((isset($_POST['category']) ? $_POST['category'] : ''));
		$al_shortcut = encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : array()));
		$al_order = encoding((isset($_POST['order']) ? $_POST['order'] : array()));
		$al_shortcut = implode(":", $al_shortcut);
		if (in_array("all", $al_shortcut)) {
			$al_shortcut="all";
		}
		$al_show_title_category=encoding((isset($_POST['show_title_category']) ? $_POST['show_title_category'] : ''));
		$al_prepare_module_content="{type_menu{category{".
		$al_show_title_category."}}}";
		$al_error = array(
			"Title:input:fill:30" => $al_title,
			"Position:input:fill:30" => $al_position,
			"Shortcut:input:fill:30" => $al_shortcut
		);
		error_message(true, $al_error);

		if (empty($_SESSION['error_message'])){
			
			$update_link = $al_connexion->prepare("UPDATE ".HASH."_modules SET modules=?, shortcut=?, category=?, title=?, position=? WHERE id=?");
			$update_link->execute(
				array(
					$al_prepare_module_content,
					$al_shortcut,
					format_link($al_title),
					$al_title,
					$al_position,
					$al_id_menu
				)
			);
			$update_link = $al_connexion->prepare("UPDATE ".HASH."_category SET category=? WHERE category=?");
			$update_link->execute(array(format_link($al_title),$al_category));
			
			foreach($al_order as $key => $value){
				$update_link = $al_connexion->prepare("UPDATE ".HASH."_link_menu SET order1=? WHERE id=?");
				$update_link->execute(array($value,$key));
			}
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
	
	function post_link_menu($al_connexion){
		$al_shortcut=encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : ''));
		foreach($al_shortcut as $al_key => $al_value){				
			if($al_value){
				$select1 = $al_connexion->prepare("SELECT COUNT(*) FROM  ".HASH."_link_menu WHERE shortcut = :al_value");
				$select1->bindParam(':al_value', format_link($al_value));
				$select1->execute();
				$number_of_rows = $select1->fetchColumn();
				if($number_of_rows > 1){
					$shortcut_link=substr(md5($al_value.rand(0,10000000000)), 0, 6);
				}
				else {
					$shortcut_link=format_link($al_value);
				}
				$update_link = $al_connexion->prepare("UPDATE ".HASH."_link_menu SET name=?,shortcut=? WHERE id=?");
				$update_link->execute(array($al_value,$shortcut_link,$al_key));
			}
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}
	
	function post_section_menu($al_connexion){
		$al_id_section=decoding((isset($_GET['id_section']) ? $_GET['id_section'] : ''));
		$al_title=encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_shortcut=encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : array()));
		$al_error = array(
			"Title:input:fill:30" => $al_title,
			"Shortcut:input:fill:30" => $al_shortcut
		);
		error_message(true, $al_error);
		if(empty($_SESSION['error_message'])){
			$update_link = $al_connexion->prepare("UPDATE ".HASH."_link_menu SET id_index=? WHERE id_index=?");
			$update_link->execute(array('0',$al_id_section));
						
			foreach($al_shortcut as $al_key => $al_value){
				$update_link = $al_connexion->prepare("UPDATE ".HASH."_link_menu SET id_index=? WHERE shortcut=?");
				$update_link->execute(array($al_id_section,$al_value));
			}
			$update_link = $al_connexion->prepare("UPDATE ".HASH."_section_name SET section=? WHERE id=?");
			$update_link->execute(array($al_title,$al_id_section));
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}
	
	function section_link_menu ($al_connexion) {
		$al_id_section=decoding((isset($_GET['id_section']) ? $_GET['id_section'] : ''));
		$al_id_module=decoding((isset($_GET['id_module']) ? $_GET['id_module'] : ''));
		$select1=$al_connexion->prepare("SELECT * FROM  ".HASH."_section_name WHERE id = :al_id_section");
		$select1->bindParam(':al_id_section', $al_id_section);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_section_name = $select1->fetch();
		
		return render(array('al_connexion' => $al_connexion, 'al_fetch_section_name' => $al_fetch_section_name, 'al_id_module' => $al_id_module), 'menus', 'menu_pages');
	}
	
	function delete_link_menu ($al_connexion) {
		$al_id_link=decoding((isset($_GET['id_link']) ? $_GET['id_link'] : ''));
		$al_id_index=decoding((isset($_GET['id_index']) ? $_GET['id_index'] : ''));
		$select2=$al_connexion->prepare("SELECT * FROM ".HASH."_link_menu WHERE id = :al_id_link AND id_index = :al_id_index");
		$select2->bindParam(':al_id_index', $al_id_index);
		$select2->bindParam(':al_id_link', $al_id_link);
		$select2->execute();
		$select2->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_link_menu = $select2->fetch();
		$al_menu_item_name = $al_fetch_link_menu->shortcut;
		$select1=$al_connexion->prepare("DELETE FROM ".HASH."_link_menu WHERE id = :al_id_link");
		$select1->bindParam(':al_id_link', $al_id_link);
		$select1->execute();
		$select3=$al_connexion->query("SELECT * FROM ".HASH."_modules WHERE shortcut LIKE '%".$al_menu_item_name."%'");
		$select3->setFetchMode(PDO::FETCH_OBJ);
		while($al_fetch_module = $select3->fetch()){
			$shortcut_all = explode(':',$al_fetch_module->shortcut);
			$al_id_module = $al_fetch_module->id;
			$full_module_shortcut=array();
			foreach($shortcut_all as $key => $value){
				if($value!=$al_menu_item_name){
					$full_module_shortcut[]=$value;
				}				
			}
			$full_shortcut=implode(':',$full_module_shortcut);
			$update_link = $al_connexion->prepare("UPDATE ".HASH."_modules SET shortcut=? WHERE id=?");
			$update_link->execute(array($full_shortcut,$al_id_module));
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}	
?>