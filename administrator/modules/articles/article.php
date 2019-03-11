<?php
	function modif_modif_article($al_connexion) {
		$al_id = decoding((isset($_GET['id_article']) ? $_GET['id_article'] : ''));
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_category = encoding((isset($_POST['category']) ? $_POST['category'] : ''));
		$al_publish = encoding((isset($_POST['publish']) ? $_POST['publish'] : ''));
		$al_value = encoding_ck((isset($_POST['value']) ? $_POST['value'] : ''));
		$al_id_module = encoding((isset($_POST['id_module']) ? $_POST['id_module'] : ''));
		$al_shortcut = encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : array()));
		$al_shortcut = implode(":", $al_shortcut);
		$al_show_title=encoding((isset($_POST['show_title']) ? $_POST['show_title'] : ''));
		$al_show_description=encoding((isset($_POST['show_description']) ? $_POST['show_description'] : ''));
		$al_show_username=encoding((isset($_POST['show_username']) ? $_POST['show_username'] : ''));
		$al_show_time=encoding((isset($_POST['show_time']) ? $_POST['show_time'] : ''));
		$al_show_date=encoding((isset($_POST['show_date']) ? $_POST['show_date'] : ''));
		$al_prepare_article_content="{article{".
		$al_show_title.":".
		$al_show_description.":".
		$al_show_username.":".
		$al_show_time.":".
		$al_show_date."}}";
		$al_error = array(
			"Title:input:fill:30" => $al_title,
			"Text:textarea:fill:30" => $al_value
		);

		error_message(true, $al_error);

		if (empty($_SESSION['error_message'])){			
			$update_article = $al_connexion->prepare("UPDATE ".HASH."_articles SET content=?, title=?, publish=?, category=?, shortcut=?, modules=? WHERE id=?");
			$update_article->execute(
				array( 
					$al_value,
					$al_title,
					$al_publish,
					$al_category,
					$al_shortcut,
					$al_prepare_article_content,
					$al_id
				)
			);
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}

	function modif_article ($al_connexion) {
		$al_id_article=decoding((isset($_GET['id_article']) ? $_GET['id_article'] : ''));
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_articles WHERE id = :al_id_article");
		$select1->bindParam(':al_id_article', $al_id_article);
		$select1->execute();	
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_articles = $select1->fetch();
		
		return render(array('al_fetch_articles' => $al_fetch_articles, 'al_connexion' => $al_connexion), 'articles', 'mod_article');
	}

	function post_update_article ($al_connexion) {
		$al_id = (isset($_GET['id']) ? $_GET['id'] : '');
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_category =  encoding((isset($_POST['category']) ? $_POST['category'] : ''));
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
			"Title:input:fill:30" => $al_title
		);
		error_message(true, $al_error);

		if (empty($_SESSION['error_message'])){
			$update_article = $al_connexion->prepare("UPDATE ".HASH."_category SET category=? WHERE category=?");
			$update_article->execute(array(format_link($al_title),$al_category));
			$update_article = $al_connexion->prepare("UPDATE ".HASH."_modules SET modules=?,shortcut=?,category=?,title=?,position=? WHERE id=?");
			$update_article->execute(
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

	function post_add_article($al_connexion) {
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_category = encoding((isset($_POST['category']) ? $_POST['category'] : ''));
		$al_publish = encoding((isset($_POST['publish']) ? $_POST['publish'] : ''));
		$al_value = encoding_ck((isset($_POST['value']) ? $_POST['value'] : ''));
		$al_shortcut = encoding((isset($_POST['shortcut']) ? $_POST['shortcut'] : array()));
		$al_shortcut = implode(":", $al_shortcut);
		$al_show_title=encoding((isset($_POST['show_title']) ? $_POST['show_title'] : ''));
		$al_show_description=encoding((isset($_POST['show_description']) ? $_POST['show_description'] : ''));
		$al_show_username=encoding((isset($_POST['show_username']) ? $_POST['show_username'] : ''));
		$al_show_time=encoding((isset($_POST['show_time']) ? $_POST['show_time'] : ''));
		$al_show_date=encoding((isset($_POST['show_date']) ? $_POST['show_date'] : ''));
		$al_prepare_article_content="{article{".
		$al_show_title.":".
		$al_show_description.":".
		$al_show_username.":".
		$al_show_time.":".
		$al_show_date."}}";
		$al_pseudo=$_SESSION['pseudom'];
		$al_date=date('Y-m-d');
		$al_time=date('H:i:s');
		$al_error = array(
			"Title:input:fill:30" => $al_title,
			"Text:input:fill:30" => $al_value
		);
		error_message(true, $al_error);
		
		if (empty($_SESSION['error_message'])){
			if($al_category){
				$query = $al_connexion->prepare("INSERT INTO ".HASH."_articles (title, username, category, modules, shortcut, date, time, order1, content, publish) VALUES(:title,:username,:category,:modules,:shortcut,:date,:time,:order1,:content,:publish)");
				$query->execute(
					array(
					':title'=>$al_title,
					':username'=>$al_pseudo,
					':category'=>$al_category,
					':modules'=> '0',
					':shortcut'=> '',
					':date'=>$al_date,
					':time'=>$al_time,
					':order1'=>'1',
					':content'=>$al_value,
					':publish'=>$al_publish
					)
				);
			}
			if(empty($al_category) && empty($al_shortcut)){ 
				$query = $al_connexion->prepare("INSERT INTO ".HASH."_articles (title, username, modules, shortcut, category, date, time, order1, content, publish) VALUES(:title,:username,:modules,:shortcut,:category,:date,:time,:order1,:content,:publish)");
				$query->execute(
					array(
					':title'=>$al_title,
					':username'=>$al_pseudo,
					':modules'=>$al_prepare_article_content,
					':shortcut'=>$al_shortcut,
					':category'=>'0',
					':date'=>$al_date,
					':time'=>$al_time,
					':order1'=>'1',
					':content'=>$al_value,
					':publish'=>$al_publish
					)
				);
			}
			if(empty($al_category) && empty($al_shortcut)){ 
				$_SESSION['error_message'].='Please enter a value ! (Field Page affected)';
			}
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}

	function article ($al_connexion) {
		$al_id_module=(isset($_GET['id']) ? $_GET['id'] : '');
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_modules WHERE id = :al_id_article");
		$select1->bindParam(':al_id_article', $al_id_module);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_modules = $select1->fetch();
		
		return render(array('al_fetch_modules' => $al_fetch_modules, 'al_id_module' => $al_id_module, 'al_connexion' => $al_connexion), 'articles', 'edit_article');
	}
	
	function add_article ($al_connexion) {		
		return render(array('al_connexion' => $al_connexion), 'articles', 'add_article');
	}
	
?>