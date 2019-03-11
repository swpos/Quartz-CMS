<?php 
	$al_error = array();
	session_start();
	if(isset($_POST['site_title'])){
		if(!empty($_POST['site_title'])){$_SESSION['site_title'] = htmlentities(htmlspecialchars($_POST['site_title'],ENT_QUOTES));
		}else { $al_error[] = "The title field is not filled in !";}
	}
	
	if(isset($_POST['site_username'])){
		$al_pattern = "/^[a-zA-Z0-9]+$/";
		if(preg_match($al_pattern, $_POST['site_username']) && !empty($_POST['site_username'])){$_SESSION['site_username']=htmlentities($_POST['site_username']);
		}else {$al_error[] = "The username is invalid or it is not filled in. It must contain only Letters and Numbers !";}
	}

	if(isset($_POST['site_password']))
	{
		if($_POST['site_password']==$_POST['site_password2'] && !empty($_POST['site_password'])){$_SESSION['site_password']=md5($_POST['site_password']);
		}else {$al_error[] = "The two password dosen't match or are not filled in !";}
	}

	if(isset($_POST['site_email']))
	{
		if($_POST['site_email'] == $_POST['site_email2'] && !empty($_POST['site_email'])){$_SESSION['site_email'] = $_POST['site_email'];
		}else { $al_error[] = "The two email dosen't match or are not filled in !";}
	}
	
	if($al_error) {
		$_SESSION['error']=$al_error;
		header('Location: step1.php');
		exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>INSTALLATION - Quartz CMS - Step 2</title>
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
	</head>
	
	<body>
		<div id="wrapper">
			<div align="center">
				<form action="finish.php" method="post">
					<table cellpadding="0" cellspacing="30" width="100%">
						<tr>
							<th><img src="css/logo.jpg" /></th>
							<th style="font-size:54px; font-family:Arial, Helvetica, sans-serif;">Quartz <br /> a CMS for everyone</th>
						</tr>

						<?php 
							session_start();
							$al_tableau = $_SESSION['error2'];
							if($al_tableau){
						?>
						<tr>
							<td style="font-size:20px; font-family:Arial, Helvetica, sans-serif;" align="center"><?php if($al_tableau){echo"ERROR : ";} ?></td>
							<td align="center">
						<?php 
							foreach($al_tableau as $al_key => $al_value){echo"$al_value<br />";	}
						?>
							</td>
						</tr>
						<?php } ?>

						<tr>
							<td style="font-size:20px; font-family:Arial, Helvetica, sans-serif;" align="center">The Mysql host</td>
							<td align="center"><input type="text" size="30" name="database_host"  value="<?php if(isset($_SESSION['database_host'])){echo $_SESSION['database_host'];} ?>" /></td>
							
						</tr>
						
						<tr>
							<td style="font-size:20px; font-family:Arial, Helvetica, sans-serif;" align="center">The database</td>
							<td align="center"><input type="text" size="30" name="database_name" value="<?php if(isset($_SESSION['database_name'])){echo $_SESSION['database_name'];} ?>" /></td>
						</tr>
						
						<tr>
							<td style="font-size:20px; font-family:Arial, Helvetica, sans-serif;" align="center">The database User</td>
							<td align="center"><input type="text" size="30" name="database_user" value="<?php if(isset($_SESSION['database_user'])){echo $_SESSION['database_user'];} ?>" /></td>
						</tr>
						
						<tr>
							<td style="font-size:20px; font-family:Arial, Helvetica, sans-serif;" align="center">The database password</td>
							<td align="center"><input type="password" size="30" name="database_password" /></td>
						</tr>
						
						<tr>
							<td style="font-size:20px; font-family:Arial, Helvetica, sans-serif;" align="center">Hash protection table (prefix) <br />(between 2 and 7 caracters inclusively)</td>
							<td align="center"><input type="text" size="30" name="prefix_table" value="<?php if(isset($_SESSION['prefix_table'])){echo $_SESSION['prefix_table'];}else{echo"cms";} ?>" /></td>
						</tr>
						
						<tr>
							<td></td>
							<td align="right"><input type="button" onclick="window.history.go(-1)" value="Previous" /><input type="submit" value="Finish" /></td>
						</tr>
					</table>
				</form>
				<?php $_SESSION['error2']=""; ?>
			</div>
		</div>
	</body>
</html>