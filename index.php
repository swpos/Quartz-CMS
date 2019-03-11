<?php
	header('Content-Type: text/html; charset=utf-8');
	ini_set('display_errors', 0);
	if(file_exists('config.php')){ include('config.php'); }
	else{die('The config file dosen\'t exist !'); }
	session_start();
	$_SESSION['editor']=$editor;
	if(!isset($_SESSION['error_message'])) { $_SESSION['error_message'] = ''; }
	if(!isset($_SESSION['populate'])) { $_SESSION['populate'] = array(); }
	include('functions/database/'.$al_type_mysql.'.php');
	include('functions/load/variables.php');
	include('libraries/view.php');
	include('libraries/shortcut.php');
	
	if((ifpause($al_connexion)) && !isset($_SESSION['pseudom'])){die('This site is presently not available. Please come back later.');}
	$templatetitle=loadtemplatetitle($al_connexion);
	if(file_exists("templates/".$templatetitle."/html/articles/article.php")){include("templates/".$templatetitle."/html/articles/article.php");}
	else {include("modules/articles/article.php");}
	if(file_exists("templates/".$templatetitle."/html/menus/menu.php")){include("templates/".$templatetitle."/html/menus/menu.php");}
	else {include("modules/menus/menu.php");}
	
	/* ----ADD PLUGINS----- */
	$select1=$al_connexion->query("SELECT * FROM ".HASH."_plugins WHERE publish='1'");
	$select1->setFetchMode(PDO::FETCH_OBJ);
	while($al_fetch_plugins = $select1->fetch()){
		$plugin_name=$al_fetch_plugins->content;
				
		if(file_exists("templates/".$templatetitle."/html/".$plugin_name."/".$plugin_name.".php")){
			include("templates/".$templatetitle."/html/".$plugin_name."/".$plugin_name.".php");
		} else {
			if(file_exists("modules/".$plugin_name."/".$plugin_name.".php")){
				include("modules/".$plugin_name."/".$plugin_name.".php");
			}
		}
	}
	//----------------//
	include('functions/load/template.php');
	if(isset($_GET['id'])){ $al_id = $_GET['id']; }else{ $al_id = '0'; }
	if(isset($_GET['page'])){ $al_page = $_GET['page']; }else{ $al_page = '0'; }
	if(isset($_GET['action'])){ $al_action = $_GET['action']; }else{ $al_action = '0'; }
	if(isset($_GET['pseudo'])){ $al_pseudo = $_GET['pseudo']; }else{ $al_pseudo = '0'; }
	$al_site_title = '';
	load_template($al_connexion,$al_site_title,load_modules($al_connexion,$al_page, $al_action, $al_id, $al_pseudo),$al_page);
?>