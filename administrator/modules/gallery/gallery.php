<?php

	function gallery_addmodule($al_connexion) {	
		return render(array('al_connexion' => $al_connexion), 'gallery', 'add_module');
	}
	
	function post_gallery_addmodule ($al_connexion) {
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_position = encoding((isset($_POST['position']) ? $_POST['position'] : ''));
		$al_shortcut = encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : array()));
		$al_shortcut = implode(":", $al_shortcut);
		$al_show_title= encoding((isset($_POST['show_title']) ? $_POST['show_title'] : ''));
		$al_show_description= encoding((isset($_POST['show_description']) ? $_POST['show_description'] : ''));
		$al_show_time = encoding((isset($_POST['show_time']) ? $_POST['show_time'] : ''));
		$al_show_date= encoding((isset($_POST['show_date']) ? $_POST['show_date'] : ''));
		$al_prepare_module_content="{type_gallery{gallery{".
		$al_show_title.":".
		$al_show_description.":".
		$al_show_time.":".
		$al_show_date."}}}";
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
				
				$select2=$al_connexion->prepare("SELECT id FROM ".HASH."_modules WHERE title = :al_title");
				$select2->bindParam(':al_title', $al_title);
				$select2->execute();
				$select2->setFetchMode(PDO::FETCH_OBJ);
				$al_fetch_modules2 = $select2->fetch();
				$id_module = $al_fetch_modules2->id;
				
				$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
				$path = "../media/gallery/"; // Upload directory
				$count = 0;

				if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
					foreach ($_FILES['files']['name'] as $f => $name) {     
						if ($_FILES['files']['error'][$f] == 4) {
							continue;
						}	       
						if ($_FILES['files']['error'][$f] == 0) {	           
							if(!in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats)){
								$message[] = "$name is not a valid format";
								continue;
							} else {
								if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$id_module."_".$name))
								$count++;
							}
						}
					}
				}
			}
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}

	function gallery ($al_connexion) {
		$al_id_module=(isset($_GET['id']) ? $_GET['id'] : '');
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_modules WHERE id = :al_id_module");
		$select1->bindParam(':al_id_module', $al_id_module);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_modules = $select1->fetch();
		
		return render(array('al_fetch_modules' => $al_fetch_modules, 'al_id_module' => $al_id_module, 'al_connexion' => $al_connexion), 'gallery', 'edit_module');
	}

	function post_gallery ($al_connexion) {
		$al_id=(isset($_GET['id']) ? $_GET['id'] : '');
		$al_content_display = '';
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_position = encoding((isset($_POST['position']) ? $_POST['position'] : ''));
		$al_shortcut = encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : array()));
		$al_shortcut = implode(":", $al_shortcut);
		$al_show_title = encoding((isset($_POST['show_title']) ? $_POST['show_title'] : ''));
		$al_category = encoding((isset($_POST['category']) ? $_POST['category'] : ''));
		$al_show_description = encoding((isset($_POST['show_description']) ? $_POST['show_description'] : ''));
		$al_show_time = encoding((isset($_POST['show_time']) ? $_POST['show_time'] : ''));
		$al_show_date = encoding((isset($_POST['show_date']) ? $_POST['show_date'] : ''));
		$al_prepare_module_content="{type_gallery{gallery{".
		$al_show_title.":".
		$al_show_description.":".
		$al_show_time.":".
		$al_show_date."}}}";
		$al_error = array(
			"Title:input:fill:30" => $al_title,
			"Position:input:fill:30" => $al_position,
			"Shortcut:input:fill:30" => $al_shortcut
		);
		error_message(true, $al_error);

		if (empty($_SESSION['error_message'])){
			$update_gallery = $al_connexion->prepare("UPDATE ".HASH."_modules SET modules=?, shortcut=?, category=?, title=?, position=? WHERE id=?");
			$update_gallery->execute(
				array(
					$al_prepare_module_content,
					$al_shortcut,
					format_link($al_title),
					$al_title,
					$al_position,
					$al_id
				)
			);
			$update_gallery = $al_connexion->prepare("UPDATE ".HASH."_category SET category=? WHERE category=?");
			$update_gallery->execute(array(format_link($al_title),$al_category));
			
			$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
			$path = "../media/gallery/";
			$count = 0;

			if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
				foreach ($_FILES['files']['name'] as $f => $name) {     
					if ($_FILES['files']['error'][$f] == 4) {
						continue;
					}	       
					if ($_FILES['files']['error'][$f] == 0) {	           
						if( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
							$message[] = "$name is not a valid format";
							continue;
						} else {
							if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$al_id."_".$name))
							$count++;
						}
					}
				}
			}
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
	
	function list_gallery ($al_connexion) {
		$al_title=encoding((isset($_POST['title_gallery']) ? $_POST['title_gallery'] : ''));
		$al_title_search=encoding((isset($_POST['title_search_gallery']) ? $_POST['title_search_gallery'] : ''));
		$al_date=encoding((isset($_POST['date_gallery']) ? $_POST['date_gallery'] : ''));
		$al_time=encoding((isset($_POST['time_gallery']) ? $_POST['time_gallery'] : ''));
		$al_post_order=encoding((isset($_POST['post_order_gallery']) ? $_POST['post_order_gallery'] : ''));
			
		$order="WHERE";
		$order1=array();
		if($al_title_search){
			$order1[].=" title LIKE '%".$al_title_search."%'";
		}
		$order1[].=" modules LIKE '%type_gallery%'";
		
		$buildQuery = $order.implode(" AND ",$order1);
	
		if($al_title || $al_date || $al_time){
			$order=	" ORDER BY";
			$order2=array();
			if($al_title){
				$order2[].=" title ".$al_title;
			}
			if($al_time){
				$order2[].=" time ".$al_time;
			}
			if($al_date){
				$order2[].=" date ".$al_date;
			}
			$buildQuery.=$order.implode(", ",$order2);
		}
		if(isset($_POST['post_order_gallery'])){
			$_SESSION['order_gallery_query'] = $buildQuery;
		} else {
			if(isset($_SESSION['order_gallery_query'])){
				$buildQuery = $_SESSION['order_gallery_query'];
			} else {
				$buildQuery = "WHERE modules LIKE '%type_gallery%'";
			}
		}
		
		$select1=$al_connexion->query("SELECT * FROM ".HASH."_modules $buildQuery LIMIT ".get_pagination());
		$select1->setFetchMode(PDO::FETCH_OBJ);

		$select2=$al_connexion->query("SELECT * FROM ".HASH."_modules");
		$al_init_gallery_rows = $select2->rowCount();
		
		return render(array('select1' => $select1, 'al_init_gallery_rows' => $al_init_gallery_rows, 'al_connexion' => $al_connexion), 'gallery', 'galeries_list');
	}
	
	function show_list_gallery ($al_connexion) {
		$al_id=encoding((isset($_GET['id_gallery']) ? $_GET['id_gallery'] : ''));
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_modules WHERE id = :al_id");
		$select1->bindParam(':al_id', $al_id);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_gallery = $select1->fetch();
		
		return render(array('al_fetch_gallery' => $al_fetch_gallery, 'al_connexion' => $al_connexion), 'gallery', 'edit_gallery');
	}
?>