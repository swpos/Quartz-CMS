<?php
	function load_article ($al_connexion,$al_category, $al_id_module, $al_modules, $al_shortcut, $al_title_module, $al_id_blog, $al_magic_key){
		$select1=$al_connexion->query("SELECT * FROM ".HASH."_articles WHERE category='$al_category' AND publish='1' ORDER BY order1");
		$select1->setFetchMode(PDO::FETCH_OBJ);
		
		return render(array('al_connexion' => $al_connexion, 'al_modules' => $al_modules, 'al_title_module' => $al_title_module, 'select1' => $select1), 'articles', 'article');
	}
	
	function load_article_real ($al_connexion, $al_id_article){
		$select1=$al_connexion->query("SELECT * FROM ".HASH."_articles WHERE id='$al_id_article' AND category='0'");
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_articles = $select1->fetch();
		
		return render(array('al_connexion' => $al_connexion, 'al_fetch_articles' => $al_fetch_articles), 'articles', 'article_component');
	}
?>