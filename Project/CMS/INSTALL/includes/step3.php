<?php
	$al_error = array();
	session_start();
	define("HASH", $_SESSION['prefix_table']);
	
	try{
		$db = new PDO("mysql:host=".$_SESSION['database_host'].";dbname=".$_SESSION['database_name'].";charset=utf8",$_SESSION['database_user'],$_SESSION['database_password']);
	} catch(PDOException  $e ){
		$al_error[] = "Failed to connect to MySQL: ".$e;
	}
	
	function install_query($query){
		try{
			$db = new PDO("mysql:host=".$_SESSION['database_host'].";dbname=".$_SESSION['database_name'].";charset=utf8",$_SESSION['database_user'],$_SESSION['database_password']);
			$db->query($query);
			return true;
		} catch(PDOException  $e ){
			return false;
		}
	}
	
	$get_file = file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/INSTALL/includes/sql.php?username='.urlencode($_SESSION['site_username']).'&password='.urlencode($_SESSION['site_password']).'&email='.urlencode($_SESSION['site_email']).'&site='.urlencode($_SESSION['site_title']).'&hash='.urlencode(HASH), true);
	$fp = fopen('data.sql', 'w');
	fwrite($fp, $get_file);
	fclose($fp);
	
	$filename = 'data.sql';
	$templine = '';
	$lines = file($filename);
	foreach ($lines as $line){
		if (substr($line, 0, 2) == '--' || $line == '')
			continue;
		
		$templine .= $line;
		if (substr(trim($line), -1, 1) == ';'){
			if (install_query($templine)){ } else { $al_error[] = "Error performing query <strong>" . $templine . "</strong>"; }
			$templine = '';
		}
	}
	
	if($al_error) {
		$response = implode('<br />', $al_error);
		$status = "bad";
	} else {
		if(file_exists('../../config.php')) {
			$al_fp = fopen('../../config.php', 'w');
		}else {
			$al_fp = fopen('../../config.php', 'a');
		}

		fwrite($al_fp, '<?php '."\n");
		fwrite($al_fp, '$al_host = "'.$_SESSION['database_host'].'"; '."\n");
		fwrite($al_fp, '$al_user = "'.$_SESSION['database_user'].'"; '."\n");
		fwrite($al_fp, '$al_password = "'.$_SESSION['database_password'].'"; '."\n");
		fwrite($al_fp, '$al_db_name = "'.$_SESSION['database_name'].'";'."\n");
		fwrite($al_fp, '$prefix_table = "'.HASH.'";'."\n");
		fwrite($al_fp, '$al_type_mysql = "mysql"; '."\n");
		fwrite($al_fp, '$editor = "ckeditor"; '."\n");
		fwrite($al_fp, '$session_domain = "'.$_SERVER['SERVER_NAME'].'"; '."\n");
		fwrite($al_fp, '$session_time = "none"; '."\n");
		fwrite($al_fp, '$session_path = "none"; '."\n");
		fwrite($al_fp, '$timezone = "America/New_York"; '."\n");
		fwrite($al_fp, '?>');
		fclose($al_fp);
		
		$response = "Installation successful !<br /> Please verify that the config.php file has been created.<br />* Please delete the INSTALL folder for more security";
		$status = "good";
	}

	echo json_encode(['reponse' => $response, 'status' => $status]);
?>