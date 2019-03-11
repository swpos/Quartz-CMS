<?php
	function addmodule ($al_connexion) {
		return render(array('al_connexion' => $al_connexion), 'modules', 'module_list');
	}
	
	function article_addmodule($al_connexion) {
		return render(array('al_connexion' => $al_connexion), 'modules', 'add_article_module');
	}
	
	function menu_addmodule($al_connexion) {	
		return render(array('al_connexion' => $al_connexion), 'modules', 'add_menu_module');
	}
	
	function post_article_addmodule ($al_connexion) {
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_position = encoding((isset($_POST['position']) ? $_POST['position'] : ''));
		$al_shortcut = encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : array()));
		$al_shortcut = implode(":", $al_shortcut);
		if (in_array("all", $al_shortcut)) {
			$al_shortcut="all";
		}
		$al_show_title_category=encoding((isset($_POST['show_title_category']) ? $_POST['show_title_category'] : ''));
		$al_show_title=encoding((isset($_POST['show_title']) ? $_POST['show_title'] : ''));
		$al_show_description=encoding((isset($_POST['show_description']) ? $_POST['show_description'] : ''));
		$al_show_username=encoding((isset($_POST['show_username']) ? $_POST['show_username'] : ''));
		$al_show_time=encoding((isset($_POST['show_time']) ? $_POST['show_time'] : ''));
		$al_show_date=encoding((isset($_POST['show_date']) ? $_POST['show_date'] : ''));
		$al_prepare_module_content="{type_article{category{".
		$al_show_title_category."}:article{".
		$al_show_title.":".
		$al_show_description.":".
		$al_show_username.":".
		$al_show_time.":".
		$al_show_date."}}}";
		$al_error = array(
			"Position:input:fill:30" => $al_position,
			"Shortcut:input:fill:30" => $al_shortcut,
			"Title:input:fill:30" => $al_title
		);
		error_message(true, $al_error);
		if (empty($_SESSION['error_message'])){
			$select1=$al_connexion->prepare("SELECT category FROM ".HASH."_modules WHERE title = :al_title");
			$select1->bindParam(':al_title', $al_title);
			$select1->execute();
			$al_fetch_modules = $select1->rowCount();
			if($al_fetch_modules > 0){}
			else{
				$al_date=date('Y-m-d');
				$al_time=date('H:i:s');
				$query = $al_connexion->prepare("INSERT INTO ".HASH."_modules (title, category, modules, order1, date, time, shortcut, position, published) VALUES (:title, :category, :modules, :order1, :date, :time, :shortcut, :position, :published)");
				$query->execute(
					array(
					':title'=>$al_title,
					':category'=>format_link($al_title),
					':modules'=>$al_prepare_module_content,
					':order1'=>'1',
					':date'=>$al_date,
					':time'=>$al_time,
					':shortcut'=>$al_shortcut,
					':position'=>$al_position,
					':published'=>'0'
					)
				);
				$query = $al_connexion->prepare("INSERT INTO ".HASH."_category (category, date, time, order1) VALUES (:category, :date, :time, :order1)");
				$query->execute(
					array(
					':category'=>format_link($al_title),
					':date'=>$al_date,
					':time'=>$al_time,
					':order1'=>'1'
					)
				);
			}
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
	
	function post_menu_addmodule ($al_connexion) {
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_position = encoding((isset($_POST['position']) ? $_POST['position'] : ''));
		$al_section = encoding((isset($_POST['section']) ? $_POST['section'] : ''));
		$al_shortcut = encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : array()));
		$al_shortcut = implode(":", $al_shortcut);
		if (in_array("all", $al_shortcut)) {
			$al_shortcut="all";
		}
		$al_show_title_category=encoding((isset($_POST['show_title_category']) ? $_POST['show_title_category'] : ''));
		$al_prepare_module_content="{type_menu{category{".
		$al_show_title_category."}}}";		
		$al_error = array(
			"Position:input:fill:30" => $al_position,
			"Title:input:fill:30" => $al_title,
			"Pages with this menu:checkbox:check:30" => $al_shortcut,
			"Section:input:fill:30" => $al_section
		);
		error_message(true, $al_error);
		if (empty($_SESSION['error_message'])){
			$select1=$al_connexion->prepare("SELECT category FROM ".HASH."_modules WHERE title = :al_title");
			$select1->bindParam(':al_title', $al_title);
			$select1->execute();
			$al_fetch_category = $select1->rowCount();
			if(($al_fetch_category < 0) || ($al_fetch_category == 0)){
				$al_date=date('Y-m-d');
				$al_time=date('H:i:s');				
				$query = $al_connexion->prepare("INSERT INTO ".HASH."_modules (title, category, modules, order1, date, time, shortcut, position, published) VALUES (:title, :category, :modules, :order1, :date, :time, :shortcut, :position, :published)");
				$query->execute(
					array(
					':title'=>$al_title,
					':category'=>format_link($al_title),
					':modules'=>$al_prepare_module_content,
					':order1'=>'1',
					':date'=>$al_date,
					':time'=>$al_time,
					':shortcut'=>$al_shortcut,
					':position'=>$al_position,
					':published'=>'0'
					)
				);		
				$select3=$al_connexion->prepare("SELECT * FROM ".HASH."_modules WHERE category = :al_title");
				$select3->bindParam(':al_title', format_link($al_title));
				$select3->execute();
				$select3->setFetchMode(PDO::FETCH_OBJ);
				$al_fetch_modules = $select3->fetch();
				$al_id=$al_fetch_modules->id;		
				$query = $al_connexion->prepare("INSERT INTO ".HASH."_section_name (section, id_module) VALUES (:section,:id_module)");
				$query->execute(
					array(
					':section'=>$al_section,
					':id_module'=>$al_id
					)
				);
				$query = $al_connexion->prepare("INSERT INTO ".HASH."_category (category, date, time, order1) VALUES (:category,:date,:time,:order1)");
				$query->execute(
					array(
					':category'=>format_link($al_title),
					':date'=>$al_date,
					':time'=>$al_time,
					':order1'=>'1'
					)
				);
			}
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}	
?>