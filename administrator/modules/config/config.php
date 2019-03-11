<?php
	function configuration($al_connexion) {
		$select1=$al_connexion->query("SELECT * FROM ".HASH."_config WHERE id='1'");
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_config = $select1->fetch();
		
		return render(array('al_fetch_config' => $al_fetch_config, 'al_connexion' => $al_connexion), 'config', 'config');
	}
	
	function post_configuration($al_connexion) {
		$al_title = encoding((isset($_POST['title']) ? $_POST['title'] : ''));
		$al_emailadmin = encoding((isset($_POST['emailadmin']) ? $_POST['emailadmin'] : ''));
		$al_pause = encoding((isset($_POST['pause']) ? $_POST['pause'] : ''));
		$al_hash2 = encoding((isset($_POST['al_hash']) ? $_POST['al_hash'] : ''));
		$al_editor = encoding((isset($_POST['editor']) ? $_POST['editor'] : ''));
		$al_host2 = encoding((isset($_POST['al_host']) ? $_POST['al_host'] : ''));
		$al_user2 = encoding((isset($_POST['al_user']) ? $_POST['al_user'] : ''));
		$al_password2 = encoding((isset($_POST['al_password']) ? $_POST['al_password'] : ''));
		$al_db_name2 = encoding((isset($_POST['al_db_name']) ? $_POST['al_db_name'] : ''));

		if(empty($al_password2)){
			include('../config.php');
			$al_password2 = $al_password;
		}

		$al_error = array(
			"Email admin:input:fill:30" => $al_emailadmin,
			"Host:input:fill:30" => $al_host2,
			"User:input:fill:30" => $al_user2,
			"Database:input:fill:30" => $al_db_name2,
			"Hash:input:fill:30" => $al_hash2,
			"Title of the site:input:fill:30" => $al_title
		);
		error_message(true, $al_error);
		
		if (empty($_SESSION['error_message'])){
			$update_article = $al_connexion->prepare("UPDATE ".HASH."_config SET title=?,emailadmin=?,pause=? WHERE id=?");
			$update_article->execute(array($al_title, $al_emailadmin, $al_pause, '1'));
			
			if(file_exists('../config.php')) {
				$al_fp = fopen('../config.php', 'w');
			}
			else {
				$al_fp = fopen('../config.php', 'a');
			}

			fwrite($al_fp, '<?php '."\n");
			fwrite($al_fp, '$al_host = "'.$al_host2.'"; '."\n");
			fwrite($al_fp, '$al_user = "'.$al_user2.'"; '."\n");
			fwrite($al_fp, '$al_password = "'.$al_password2.'"; '."\n");
			fwrite($al_fp, '$al_db_name = "'.$al_db_name2.'";'."\n");
			fwrite($al_fp, 'define("HASH", "'.$al_hash2.'"); '."\n");
			fwrite($al_fp, '$al_type_mysql = "mysql"; '."\n");
			fwrite($al_fp, '$editor = "'.$al_editor.'"; '."\n");
			fwrite($al_fp, '?>');
			fclose($al_fp);
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
	
?>