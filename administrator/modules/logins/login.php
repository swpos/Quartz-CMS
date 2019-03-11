<?php
	function connexion ($al_connexion){		
		return render(array('al_connexion' => $al_connexion), 'logins', 'login');
	}
	
	function verif_login ($al_connexion){
		$al_pseudo_membre=encoding((isset($_POST['username']) ? $_POST['username'] : ''));
		$al_passe_membre=encoding((isset($_POST['password']) ? $_POST['password'] : ''));
		$al_passe_membre=md5($al_passe_membre);
		$al_error = array(
			"Username:input:fill:30" => $al_pseudo_membre,
			"Password:input:fill:30" => $al_passe_membre
		);
		error_message(true, $al_error);
		
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_users WHERE password = :al_passe_membre AND username = :al_pseudo_membre");
		$select1->bindParam(':al_passe_membre', $al_passe_membre);
		$select1->bindParam(':al_pseudo_membre', $al_pseudo_membre);
		$select1->execute();
		$al_verif_nb = $select1->rowCount();
		
		if($al_verif_nb==0){
			$_SESSION['error_message'].='The user does not exists';
		}
		
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_row = $select1->fetch();
		$al_block=$al_row->blocked;
		if($al_block=="1"){
			if($al_enable_blocked=='yes'){
				$_SESSION['error_message'].='Sorry  can\'t log in';
			}
		}
		if(empty($_SESSION['error_message'])){
			$al_ip = $_SERVER['REMOTE_ADDR'];
			$update_user = $al_connexion->prepare("UPDATE ".HASH."_users SET ip=? WHERE password=? AND username=?");
			$update_user->execute(array($al_ip,$al_passe_membre,$al_pseudo_membre));
			
			$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_users WHERE username = :al_pseudo_membre");
			$select1->bindParam(':al_pseudo_membre', $al_pseudo_membre);
			$select1->execute();
			$select1->setFetchMode(PDO::FETCH_OBJ);
			$al_fetch_users = $select1->fetch();
			
			$al_pseudo_session=decoding($al_fetch_users->username);
			$_SESSION['pseudom'] = $al_pseudo_session;
		}
		header('Location: index.php?page=cpanel');
	}
	
	function disconnect($al_connexion) {
		session_unset();
		session_destroy();
		header('Location: index.php');
		exit;
	}
?>