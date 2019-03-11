<?php 
	ini_set('display_errors', 1);

	$al_error = array();
	session_start();
	if(isset($_POST['database_host'])){
		if(!empty($_POST['database_host'])){$_SESSION['database_host'] = $_POST['database_host'];}
		else { $al_error[] = "The database host field is not filled in !";}
	}

	if(isset($_POST['database_name'])){
		if(!empty($_POST['database_name'])){$_SESSION['database_name'] = $_POST['database_name'];}
		else { $al_error[] = "The database name field is not filled in !";}
	}

	if(isset($_POST['database_user'])){
		if(!empty($_POST['database_user'])){$_SESSION['database_user'] = $_POST['database_user'];}
		else { $al_error[] = "The database user field is not filled in !";}
	}

	if(isset($_POST['database_password'])){
		if(!empty($_POST['database_password'])){$_SESSION['database_password'] = $_POST['database_password'];}
		else { $al_error[] = "The database password field is not filled in !";}
	}
	
	if(isset($_POST['prefix_table'])){
		if(!empty($_POST['prefix_table'])){$_SESSION['prefix_table'] = $_POST['prefix_table'];}
		else { $al_error[] = "The prefix for table field is not filled in !";}
		
		$al_pattern = "/^[a-zA-Z0-9]+$/";
		if(preg_match($al_pattern, $_POST['prefix_table']) && !empty($_POST['prefix_table'])){
		}else {$al_error[] = "The prefix for table is invalid. It must contain only Letters and Numbers !";}
		
		if(strlen($_POST['prefix_table']) > 7){$al_error[] = "The prefix for table is too big.";}
		if(strlen($_POST['prefix_table']) < 2){$al_error[] = "The prefix for table is too small.";}
	}

	if($al_error) {
		$_SESSION['error2']=$al_error;
		header('Location: step2.php');	
		exit();
	} else {
		define("HASH", (isset($_POST['prefix_table']) ? $_POST['prefix_table'] : ''));
		$al_link = mysqli_connect($_SESSION['database_host'],$_SESSION['database_user'],$_SESSION['database_password'],$_SESSION['database_name']);
		if (empty($al_link)){$al_error[] = "Failed to connect to MySQL: " . mysqli_error($al_link);}
		mysqli_set_charset($al_link, 'utf8');
		$get_file = file_get_contents('http://'.$_SERVER['HTTP_HOST'].'/INSTALL/sql.php?username='.urlencode($_SESSION['site_username']).'&password='.urlencode($_SESSION['site_password']).'&email='.urlencode($_SESSION['site_email']).'&site='.urlencode($_SESSION['site_title']).'&hash='.urlencode($_POST['prefix_table']), true);
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
				mysqli_query($al_link, $templine) or ($al_error[] = "Error performing query <strong>" . $templine . ": " . mysqli_error($al_link) . "</strong>");
				$templine = '';
			}
		}
		
		if($al_error) {
			$_SESSION['error2']=$al_error;
			header('Location: step2.php');	
			exit();
		}else {		
			if(file_exists('../config.php')) {
				$al_fp = fopen('../config.php', 'w');
			}else {
				$al_fp = fopen('../config.php', 'a');
			}

			fwrite($al_fp, '<?php '."\n");
			fwrite($al_fp, '$al_host = "'.$_SESSION['database_host'].'"; '."\n");
			fwrite($al_fp, '$al_user = "'.$_SESSION['database_user'].'"; '."\n");
			fwrite($al_fp, '$al_password = "'.$_SESSION['database_password'].'"; '."\n");
			fwrite($al_fp, '$al_db_name = "'.$_SESSION['database_name'].'";'."\n");
			fwrite($al_fp, 'define("HASH", "'.HASH.'");'."\n");
			fwrite($al_fp, '$al_type_mysql = "mysql"; '."\n");
			fwrite($al_fp, '$editor = "ckeditor"; '."\n");
			fwrite($al_fp, '?>');
			fclose($al_fp);
		}

	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>INSTALLATION - Quartz CMS - End</title>
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
	</head>
	
	<body>
		<div id="wrapper">
			<div align="center">
				<table cellpadding="0" cellspacing="50" width="100%">
					<tr>
						<th><img src="css/logo.jpg" /></th>
						<th style="font-size:54px; font-family:Arial, Helvetica, sans-serif;">Quartz <br /> a CMS for everyone</th>
					</tr>
					
					<tr>
						<td></td>
						<td style="font-size:25px; font-family:Arial, Helvetica, sans-serif; color:#090;" align="center">Installation successful !</td>
					</tr>
					
					<tr>
						<td></td>
						<td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#999;" align="center">* Please delete the install folder located in the root directory for more security</td>
					</tr>
					
					<tr>
						<td></td>
						<td align="right"><a href="../"><img src="css/view.jpg" /></a></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>