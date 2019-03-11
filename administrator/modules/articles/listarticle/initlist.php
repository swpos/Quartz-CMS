<?php
	function list_article ($al_connexion){
		$al_search=encoding((isset($_POST['search_article']) ? $_POST['search_article'] : ''));
		$al_category=encoding((isset($_POST['category_article']) ? $_POST['category_article'] : ''));
		$al_order=encoding((isset($_POST['order_article']) ? $_POST['order_article'] : ''));
		$al_time=encoding((isset($_POST['time_article']) ? $_POST['time_article'] : ''));
		$al_date=encoding((isset($_POST['date_article']) ? $_POST['date_article'] : ''));
		$al_published=encoding((isset($_POST['published_article']) ? $_POST['published_article'] : ''));
		$al_post_order=encoding((isset($_POST['post_order_article']) ? $_POST['post_order_article'] : ''));
		$buildQuery = '';
		if($al_search || $al_published){	
			$order="WHERE";
			$order1=array();
			
			if($al_search){
				$order1[].=" title LIKE '%".$al_search."%'";
			}
			if($al_published){
				if($al_published=='yes'){$al_published="1";}
				else{$al_published="0";}
				$order1[].=" publish = '".$al_published."'";
			}
			$buildQuery.=$order.implode(" AND ",$order1);
		}
	
		if($al_category || $al_order || $al_time || $al_date){
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
			$buildQuery.=$order.implode(", ",$order2);
		}
		if(isset($_POST['post_order_article'])){
			$_SESSION['order_article_query'] = $buildQuery;
		} else {
			$buildQuery = isset($_SESSION['order_article_query']) ? $_SESSION['order_article_query'] : '';
		}
		
		$select1=$al_connexion->query("SELECT * FROM ".HASH."_articles ".$buildQuery." LIMIT ".get_pagination());
		$select1->setFetchMode(PDO::FETCH_OBJ);
		
		$select2=$al_connexion->query("SELECT * FROM ".HASH."_articles");
		$al_init_articles_rows = $select2->rowCount();
		
		return render(array('select1' => $select1, 'al_init_articles_rows' => $al_init_articles_rows, 'al_connexion' => $al_connexion), 'articles', 'articles_list');
	}
	
	function order_article ($al_connexion){
		$al_order=decoding((isset($_POST['order']) ? $_POST['order'] : array()));
		foreach($al_order as $al_key => $al_value){
			$update_article = $al_connexion->prepare("UPDATE ".HASH."_articles SET order1=? WHERE id=?");
			$update_article->execute(array($al_value,$al_key));
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}
	
	function delete_article ($al_connexion){	
		$al_id=decoding((isset($_GET['id']) ? $_GET['id'] : ''));
		$select1=$al_connexion->prepare("DELETE FROM ".HASH."_articles WHERE id = :al_id");
		$select1->bindParam(':al_id', $al_id);
		$select1->execute();
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}
	
	function publish_article ($al_connexion){	
		$al_id=decoding((isset($_GET['id']) ? $_GET['id'] : ''));
		$al_state=decoding((isset($_GET['state']) ? $_GET['state'] : ''));
		if($al_state=='Yes'){$al_enable=0;}else{$al_enable=1;}
		$update_module = $al_connexion->prepare("UPDATE ".HASH."_articles SET publish=? WHERE id=?");
		$update_module->execute(array($al_enable,$al_id));
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}

?>