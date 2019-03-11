<?php
	function counter_addmodule($al_connexion) {
		return render(array('al_connexion' => $al_connexion), 'counter', 'add_module');
	}
	
	function post_counter_addmodule ($al_connexion) {
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_position = encoding((isset($_POST['position']) ? $_POST['position'] : ''));
		$al_shortcut = encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : array()));
		$al_shortcut = implode(":", $al_shortcut);
		$al_show_title= encoding((isset($_POST['show_title']) ? $_POST['show_title'] : ''));
		$al_prepare_module_content="{type_counter{counter{".
		$al_show_title."}}}";
		$al_error = array(
			"Position:input:fill:30" => $al_position,
			"Shortcut:input:fill:30" => $al_shortcut,
			"Title:input:fill:30" => $al_title,
		);
		error_message(true, $al_error);
		
		if (empty($_SESSION['error_message'])){
			$select1=$al_connexion->prepare("SELECT category FROM ".HASH."_modules WHERE title = :al_title");
			$select1->bindParam(':al_title', $al_title);
			$select1->execute();
			$al_fetch_modules = $select1->rowCount();
			if(($al_fetch_modules < 0) || ($al_fetch_modules == 0)){
				$al_date=date('Y-m-d');
				$al_time=date('H:i:s');
				$query = $al_connexion->prepare("INSERT INTO ".HASH."_modules (title, category, modules, order1, date, time, shortcut, position, published) VALUES (:title,:category,:modules,:order1,:date,:time,:shortcut,:position,:published)");
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
			}
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}

	function counter ($al_connexion) {
		$al_id_module = (isset($_GET['id']) ? $_GET['id'] : '');
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_modules WHERE id = :al_id_module");
		$select1->bindParam(':al_id_module', $al_id_module);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_modules = $select1->fetch();
		
		return render(array('al_connexion' => $al_connexion, 'al_fetch_modules' => $al_fetch_modules, 'al_id_module' => $al_id_module), 'counter', 'edit_module');
	}

	function post_counter ($al_connexion) {
		$al_id=(isset($_GET['id']) ? $_GET['id'] : '');
		$al_content_display = '';
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_position = encoding((isset($_POST['position']) ? $_POST['position'] : ''));
		$al_shortcut = encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : array()));
		$al_shortcut = implode(":", $al_shortcut);
		$al_show_title = encoding((isset($_POST['show_title']) ? $_POST['show_title'] : ''));
		$al_category = encoding((isset($_POST['category']) ? $_POST['category'] : ''));
		$al_show_description = encoding((isset($_POST['show_description']) ? $_POST['show_description'] : ''));
		$al_show_username = encoding((isset($_POST['show_username']) ? $_POST['show_username'] : ''));
		$al_show_time = encoding((isset($_POST['show_time']) ? $_POST['show_time'] : ''));
		$al_show_date = encoding((isset($_POST['show_date']) ? $_POST['show_date'] : ''));
		$al_prepare_module_content="{type_counter{counter{".
		$al_show_title."}}}";
		$al_error = array(
			"Title:input:fill:30" => $al_title,
			"Position:input:fill:30" => $al_position,
			"Shortcut:input:fill:30" => $al_shortcut
		);
		error_message(true, $al_error);

		if (empty($_SESSION['error_message'])){
			$update_counter = $al_connexion->prepare("UPDATE ".HASH."_category SET category=? WHERE category=?");
			$update_counter->execute(array(format_link($al_title),$al_category));
			$update_counter = $al_connexion->prepare("UPDATE ".HASH."_modules SET modules=?, shortcut=?, category=?, title=?, position=? WHERE id=?");
			$update_counter->execute(
				array(
					$al_prepare_module_content,
					$al_shortcut,
					format_link($al_title),
					$al_title,
					$al_position,
					$al_id
				)
			);
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
	
	function counter_main ($al_connexion) {
		return render(array('al_connexion' => $al_connexion), 'counter', 'main_module');
	}

?>