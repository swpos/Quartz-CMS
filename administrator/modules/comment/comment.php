<?php

	function comment_addmodule($al_connexion) {	
		return render(array('al_connexion' => $al_connexion), 'comment', 'add_module');
	}
	
	function post_comment_addmodule ($al_connexion) {
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_position = encoding((isset($_POST['position']) ? $_POST['position'] : ''));
		$al_shortcut = encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : array()));
		$al_shortcut = implode(":", $al_shortcut);
		$al_show_title= encoding((isset($_POST['show_title']) ? $_POST['show_title'] : ''));
		$al_show_description= encoding((isset($_POST['show_description']) ? $_POST['show_description'] : ''));
		$al_show_username= encoding((isset($_POST['show_username']) ? $_POST['show_username'] : ''));
		$al_show_time = encoding((isset($_POST['show_time']) ? $_POST['show_time'] : ''));
		$al_show_date= encoding((isset($_POST['show_date']) ? $_POST['show_date'] : ''));
		$al_prepare_module_content="{type_comment{comments{".
		$al_show_title.":".
		$al_show_description.":".
		$al_show_username.":".
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
			}
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}

	function comment ($al_connexion) {
		$al_id_module=(isset($_GET['id']) ? $_GET['id'] : '');
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_modules WHERE id = :al_id_module");
		$select1->bindParam(':al_id_module', $al_id_module);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_modules = $select1->fetch();
		
		return render(array('al_fetch_modules' => $al_fetch_modules, 'al_id_module' => $al_id_module, 'al_connexion' => $al_connexion), 'comment', 'edit_module');
	}

	function post_comment ($al_connexion) {
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
		$al_prepare_module_content="{type_comment{comments{".
		$al_show_title.":".
		$al_show_description.":".
		$al_show_username.":".
		$al_show_time.":".
		$al_show_date."}}}";
		$al_error = array(
			"Title:input:fill:30" => $al_title,
			"Position:input:fill:30" => $al_position,
			"Shortcut:input:fill:30" => $al_shortcut
		);
		error_message(true, $al_error);

		if (empty($_SESSION['error_message'])){
			$update_comment = $al_connexion->prepare("UPDATE ".HASH."_modules SET modules=?, shortcut=?, category=?, title=?, position=? WHERE id=?");
			$update_comment->execute(
				array(
					$al_prepare_module_content,
					$al_shortcut,
					format_link($al_title),
					$al_title,
					$al_position,
					$al_id
				)
			);
			$update_comment = $al_connexion->prepare("UPDATE ".HASH."_category SET category=? WHERE category=?");
			$update_comment->execute(array(format_link($al_title),$al_category));
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
	
	function list_comments ($al_connexion) {
		$al_title=encoding((isset($_POST['title_comment']) ? $_POST['title_comment'] : ''));
		$al_title_search=encoding((isset($_POST['title_search_comment']) ? $_POST['title_search_comment'] : ''));
		$al_username=encoding((isset($_POST['username_comment']) ? $_POST['username_comment'] : ''));
		$al_username_search=encoding((isset($_POST['username_search_comment']) ? $_POST['username_search_comment'] : ''));
		$al_date=encoding((isset($_POST['date_comment']) ? $_POST['date_comment'] : ''));
		$al_time=encoding((isset($_POST['time_comment']) ? $_POST['time_comment'] : ''));
		$al_post_order=encoding((isset($_POST['post_order_comment']) ? $_POST['post_order_comment'] : ''));
		$buildQuery = '';
		
		if($al_title_search || $al_username_search){	
			$order="WHERE";
			$order1=array();
			
			if($al_title_search){
				$order1[].=" title LIKE '%".$al_title_search."%'";
			}
			if($al_username_search){
				$order1[].=" username LIKE '%".$al_username_search."%'";
			}
			$buildQuery.=$order.implode(" AND ",$order1);
		}
	
		if($al_title || $al_username || $al_date || $al_time){
			$order=	" ORDER BY";
			$order2=array();
			if($al_title){
				$order2[].=" title ".$al_title;
			}
			if($al_username){
				$order2[].=" username ".$al_username;

			}
			if($al_time){
				$order2[].=" time ".$al_time;
			}
			if($al_date){
				$order2[].=" date ".$al_date;
			}
			$buildQuery.=$order.implode(", ",$order2);
		}
		if(isset($_POST['post_order_comment'])){
			$_SESSION['order_comment_query'] = $buildQuery;
		} else {
			$buildQuery = isset($_SESSION['order_comment_query']) ? $_SESSION['order_comment_query'] : '';
		}
				
		$select1=$al_connexion->query("SELECT * FROM cms_comments $buildQuery LIMIT ".get_pagination());
		$select1->setFetchMode(PDO::FETCH_OBJ);

		$select2=$al_connexion->query("SELECT * FROM cms_comments");
		$al_init_comments_rows = $select2->rowCount();
		
		return render(array('al_connexion' => $al_connexion, 'select1' => $select1, 'al_init_comments_rows' => $al_init_comments_rows), 'comment', 'comments_list');
	}
	
	
	function update_comment_list_comments ($al_connexion) {
		$al_id=encoding((isset($_GET['id_comment']) ? $_GET['id_comment'] : ''));
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_username = encoding((isset($_POST['username']) ? $_POST['username'] : ''));
		$al_value = encoding_ck((isset($_POST['value']) ? $_POST['value'] : ''));
		$al_error = array(
			"Title:input:fill:30" => $al_title,
			"Username:input:fill:30" => $al_username,
			"Text:textarea:fill:30" => $al_value,
			"Title:input:maxLength:50" => $al_title
		);
		error_message(true, $al_error);

		if (empty($_SESSION['error_message'])){
			$update_comment = $al_connexion->prepare("UPDATE cms_comments SET title=?,content=?,username=? WHERE id=?");
			$update_comment->execute(array($al_title, $al_value, $al_username, $al_id));
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
	
	
	function show_list_comments ($al_connexion) {
		$al_id=encoding((isset($_GET['id_comment']) ? $_GET['id_comment'] : ''));
		$select1=$al_connexion->prepare("SELECT * FROM cms_comments WHERE id = :al_id");
		$select1->bindParam(':al_id', $al_id);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_comments = $select1->fetch();
		
		return render(array('al_fetch_comments' => $al_fetch_comments, 'al_connexion' => $al_connexion), 'comment', 'edit_comment');
	}
	
	function delete_list_comments ($al_connexion) {
		$al_id=encoding((isset($_GET['id_comment']) ? $_GET['id_comment'] : ''));
		$select1=$al_connexion->prepare("DELETE FROM cms_comments WHERE id='$al_id'");
		$select1->execute();
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
?>