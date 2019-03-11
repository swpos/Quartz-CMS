<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>INSTALLATION - Quartz CMS - Step 1</title>
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
	</head>
	
	<body>
		<div id="wrapper">
			<div align="center">
				<form action="step2.php" method="post">
					<table cellpadding="0" cellspacing="30" width="100%">
						<tr>
							<th><img src="css/logo.jpg" /></th>
							<th style="font-size:54px; font-family:Arial, Helvetica, sans-serif;">Quartz <br /> a CMS for everyone</th>
						</tr>

						<?php 
							session_start();
							$al_tableau = $_SESSION['error'];
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
							<td style="font-size:20px; font-family:Arial, Helvetica, sans-serif;" align="center">Choose a title for the site</td>
							<td align="center"><input type="text" size="30" name="site_title" value="<?php if(isset($_SESSION['site_title'])){echo $_SESSION['site_title'];} ?>" /></td>
						</tr>
						
						<tr>
							<td style="font-size:20px; font-family:Arial, Helvetica, sans-serif;" align="center">Choose a Username (admin)</td>
							<td align="center"><input type="text" size="30" name="site_username" value="<?php if(isset($_SESSION['site_username'])){echo $_SESSION['site_username'];} ?>" /></td>
						</tr>
						
						<tr>
							<td style="font-size:20px; font-family:Arial, Helvetica, sans-serif;" align="center">Choose a Password (admin)</td>
							<td align="center"><input type="password" size="30" name="site_password" /></td>
						</tr>
						
						<tr>
							<td style="font-size:20px; font-family:Arial, Helvetica, sans-serif;" align="center">Confirm Password (admin)</td>
							<td align="center"><input type="password" size="30" name="site_password2" /></td>
						</tr>
						
						<tr>
							<td style="font-size:20px; font-family:Arial, Helvetica, sans-serif;" align="center">Choose an Email (admin)</td>
							<td align="center"><input type="text" size="30" name="site_email"  value="<?php if(isset($_SESSION['site_email'])){echo $_SESSION['site_email'];} ?>" /></td>
						</tr>
						
						<tr>
							<td style="font-size:20px; font-family:Arial, Helvetica, sans-serif;" align="center">Confirm Email (admin)</td>
							<td align="center"><input type="text" size="30" name="site_email2"  value="<?php if(isset($_SESSION['site_email'])){echo $_SESSION['site_email'];} ?>" /></td>
						</tr>
						
						<tr>
							<td></td>
							<td align="right"><input type="submit" value="Next step" /></td>
						</tr>
					</table>
				</form>
				<?php $_SESSION['error']=""; ?>
			</div>
		</div>
	</body>
</html>