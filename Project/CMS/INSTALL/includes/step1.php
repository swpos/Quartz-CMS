<?php
	$al_error = array();
	session_start();
	if(isset($_POST['site_title'])){
		if(!empty($_POST['site_title'])){
			$_SESSION['site_title'] = htmlentities(htmlspecialchars($_POST['site_title'],ENT_QUOTES));
		} else { 
			$al_error[] = "The title field is not filled in !";
		}
	}
	
	if(isset($_POST['site_username'])){
		$al_pattern = "/^[a-zA-Z0-9]+$/";
		if(preg_match($al_pattern, $_POST['site_username']) && !empty($_POST['site_username'])){
			$_SESSION['site_username'] = htmlentities($_POST['site_username']);
		} else {
			$al_error[] = "The username is invalid or it is not filled in. It must contain only Letters and Numbers !";
		}
	}

	if(isset($_POST['site_password'])){
		if($_POST['site_password'] == $_POST['site_password2'] && !empty($_POST['site_password'])){
			$_SESSION['site_password'] = md5($_POST['site_password']);
		} else {
			$al_error[] = "The two password dosen't match or are not filled in !";
		}
	}

	if(isset($_POST['site_email'])){
		if($_POST['site_email'] == $_POST['site_email2'] && !empty($_POST['site_email'])){
			$_SESSION['site_email'] = $_POST['site_email'];
		} else { 
			$al_error[] = "The two email dosen't match or are not filled in !";
		}
	}
	
	if($al_error) {
		$reponse = implode('<br />', $al_error);
		$status = "bad";
	} else {
		$reponse = "Step 3 !";
		$status = "good";
	}

	echo json_encode(['reponse' => $reponse, 'status' => $status]);

?>