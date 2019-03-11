<?php
	function index ($al_connexion){	
		$al_search=encoding((isset($_POST['search_module']) ? $_POST['search_module'] : ''));
		$al_type=encoding((isset($_POST['type_module']) ? $_POST['type_module'] : ''));
		$al_category=encoding((isset($_POST['category_module']) ? $_POST['category_module'] : ''));
		$al_order=encoding((isset($_POST['order_module']) ? $_POST['order_module'] : ''));
		$al_time=encoding((isset($_POST['time_module']) ? $_POST['time_module'] : ''));
		$al_date=encoding((isset($_POST['date_module']) ? $_POST['date_module'] : ''));
		$al_position=encoding((isset($_POST['position_module']) ? $_POST['position_module'] : ''));
		$al_position_type=encoding((isset($_POST['position_type_module']) ? $_POST['position_type_module'] : ''));
		$al_published=encoding((isset($_POST['published_module']) ? $_POST['published_module'] : ''));
		$al_post_order=encoding((isset($_POST['post_order_module']) ? $_POST['post_order_module'] : ''));
		$buildQuery = '';
		
		if($al_type || $al_search || $al_position_type || $al_published){	
			$order="WHERE";
			$order1=array();
			if($al_search){
				$order1[].=" category LIKE '%".$al_search."%'";
			}
			if($al_type){
				$order1[].=" modules LIKE '%".$al_type."%'";
			}
			if($al_position_type){
				$order1[].=" position = '".$al_position_type."'";
			}
			if($al_published){
				if($al_published=='yes'){$al_published="1";}
				else{$al_published="0";}
				$order1[].=" published = '".$al_published."'";
			}
			$buildQuery.=$order.implode(" AND ",$order1);
		}
	
		if($al_category || $al_order || $al_time || $al_date || $al_position){
			$order=	" ORDER BY";
			$order2=array();
			if($al_category){
				$order2[].=" category ".$al_category;
			}
			if($al_order){
				$order2[].=" order1 ".$al_order;
			}
			if($al_time){
				$order2[].=" time ".$al_time;
			}
			if($al_date){
				$order2[].=" date ".$al_date;
			}
			if($al_position){
				$order2[].=" position ".$al_position;
			}
			$buildQuery.=$order.implode(", ",$order2);
		}
		if(isset($_POST['post_order_module'])){
			$_SESSION['order_module_query'] = $buildQuery;
		} else {
			$buildQuery = isset($_SESSION['order_module_query']) ? $_SESSION['order_module_query'] : '';
		}
		$select1=$al_connexion->query("SELECT * FROM ".HASH."_modules $buildQuery LIMIT ".get_pagination());
		$select1->setFetchMode(PDO::FETCH_OBJ);
		
		$select2=$al_connexion->query("SELECT * FROM ".HASH."_modules");
		$al_init_modules_rows = $select2->rowCount();
		
		return render(array('al_connexion' => $al_connexion, 'select1' => $select1, 'al_init_modules_rows' => $al_init_modules_rows), 'modules', 'modules');
	}
	
	function delete_delete_module ($al_connexion){	
		$al_id=decoding((isset($_GET['id']) ? $_GET['id'] : ''));
		
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_modules WHERE id = :al_id");
		$select1->bindParam(':al_id', $al_id);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_modules = $select1->fetch();
		
		$al_category=decoding($al_fetch_modules->category);
		$al_type_module=decoding($al_fetch_modules->modules);
		$al_id=decoding($al_fetch_modules->id);
		
		if(substr_count($al_type_module, 'type_article')){
			$select1=$al_connexion->prepare("DELETE FROM ".HASH."_articles WHERE category='$al_category'");
			$select1->execute();
		}
		
		if(substr_count($al_type_module, 'type_menu')){
			$select2=$al_connexion->query("SELECT * FROM ".HASH."_section_name WHERE id_module='$al_id'");
			$select2->setFetchMode(PDO::FETCH_OBJ);
			$al_fetch_modules = $select2->fetch();
			$al_id_menu=decoding($al_fetch_modules->id);
			$select1=$al_connexion->prepare("DELETE FROM ".HASH."_link_menu WHERE id_index='$al_id_menu'");
			$select1->execute();
			$select1=$al_connexion->prepare("DELETE FROM ".HASH."_section_name WHERE id_module='$al_id'");
			$select1->execute();
		}
		
		if(substr_count($al_type_module, 'type_comment')){
			$select1=$al_connexion->prepare("DELETE FROM ".HASH."_comments WHERE id_module='$al_id'");
			$select1->execute();
		}
		$select1=$al_connexion->prepare("DELETE FROM ".HASH."_category WHERE category='$al_category'");
		$select1->execute();
		$select1=$al_connexion->prepare("DELETE FROM ".HASH."_modules WHERE id='$al_id'");
		$select1->execute();
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}
	
	function publish_module ($al_connexion){	
		$al_id=decoding((isset($_GET['id']) ? $_GET['id'] : ''));
		$al_state=decoding((isset($_GET['state']) ? $_GET['state'] : ''));
		if($al_state=='Yes'){$al_enable=0;}else{$al_enable=1;}
		$update_module = $al_connexion->prepare("UPDATE ".HASH."_modules SET published=? WHERE id=?");
		$update_module->execute(array($al_enable,$al_id));
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}
	
	function order_module ($al_connexion){
		$al_order=decoding((isset($_POST['order']) ? $_POST['order'] : array()));
		foreach($al_order as $al_key => $al_value){
			$update_module = $al_connexion->prepare("UPDATE ".HASH."_modules SET order1=? WHERE id=?");
			$update_module->execute(array($al_value,$al_key));
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}
	
?>