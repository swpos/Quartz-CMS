<?php
	$al_error = array();
	session_start();
	if(isset($_POST['database_host'])){
		if(!empty($_POST['database_host'])){
			$_SESSION['database_host'] = $_POST['database_host'];
		} else { 
			$al_error[] = "The database host field is not filled in !";
		}
	}

	if(isset($_POST['database_name'])){
		if(!empty($_POST['database_name'])){
			$_SESSION['database_name'] = $_POST['database_name'];
		} else { 
			$al_error[] = "The database name field is not filled in !";
		}
	}

	if(isset($_POST['database_user'])){
		if(!empty($_POST['database_user'])){
			$_SESSION['database_user'] = $_POST['database_user'];
		} else { 
			$al_error[] = "The database user field is not filled in !";
		}
	}

	if(isset($_POST['database_password'])){
		if(!empty($_POST['database_password'])){
			$_SESSION['database_password'] = $_POST['database_password'];
		} else { 
			$al_error[] = "The database password field is not filled in !";
		}
	}
	
	if(isset($_POST['prefix_table'])){
		if(!empty($_POST['prefix_table'])){
			$_SESSION['prefix_table'] = $_POST['prefix_table'];
		} else { 
			$al_error[] = "The prefix for table field is not filled in !";
		}
		$al_pattern = "/^[a-zA-Z0-9]+$/";
		if(preg_match($al_pattern, $_POST['prefix_table']) && !empty($_POST['prefix_table'])){
			
		} else {
			$al_error[] = "The prefix for table is invalid. It must contain only Letters and Numbers !";
		}
		
		if(strlen($_POST['prefix_table']) > 7){
			$al_error[] = "The prefix for table is too big.";
		}
		if(strlen($_POST['prefix_table']) < 2){
			$al_error[] = "The prefix for table is too small.";
		}
	}
	
	if($al_error) {
		$reponse = implode('<br />', $al_error);
		$status = "bad";
	} else {
		$reponse = "Install data !";
		$status = "good";
	}

	echo json_encode(['reponse' => $reponse, 'status' => $status]);
?>