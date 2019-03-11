<?php 
	try {
	  $dns = 'mysql:host='.$al_host.';dbname='.$al_db_name;
	  // Options de connection
	  $options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	  );
	  $al_connexion = new PDO( $dns, $al_user, $al_password, $options );
	} catch ( Exception $e ) {
	  echo "Connection à MySQL impossible : ", $e->getMessage();
	  die();
	}
?>