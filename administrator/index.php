<?php
	ini_set('display_errors', 0);
	if(file_exists('../config.php')){ include('../config.php'); }
	else{ die('The config file dosen\'t exist !'); }

	session_start();	
	header('Content-Type: text/html; charset=utf-8');
	$_SESSION['editor']=$editor;
	if(!isset($_SESSION['error_message'])) { $_SESSION['error_message'] = ''; }
	if(!isset($_SESSION['populate'])) { $_SESSION['populate'] = array(); }
	if(isset($_GET['id'])){ $al_id = $_GET['id']; }else{ $al_id = '0'; }
	if(isset($_GET['page'])){ $al_page = $_GET['page']; }else{ $al_page = '0'; }
	if(isset($_GET['action'])){ $al_action = $_GET['action']; }else{ $al_action = '0'; }
	include('functions/database/'.$al_type_mysql.'.php');
	
	include('functions/load/variables.php');
	include('../libraries/view.php');
	include('../libraries/shortcut.php');

	if(($al_page != 'connexion') && ($al_page != 'verif_login') && ($al_page != '0')){
		security();
	}
		
	include('modules/modules/init/init.php');
	include('modules/users/user.php');
	include('modules/plugins/plugins.php');
	include('modules/logins/login.php');
	include('modules/articles/article.php');
	include('modules/modules/addmodule/init.php');
	include('modules/menus/menu.php');
	include('modules/config/config.php');
	include('modules/panel/panel.php');
	include('modules/template/template.php');
	include('modules/media/media.php');
	include('modules/articles/listarticle/initlist.php');
	/* ----ADD PLUGINS----- */

	$select1=$al_connexion->query("SELECT * FROM ".HASH."_plugins WHERE publish='1'");
	$select1->setFetchMode(PDO::FETCH_OBJ);
	
	while($al_fetch_plugins = $select1->fetch()){
		$plugin_name=$al_fetch_plugins->content;
		
		if(file_exists("modules/".$plugin_name."/".$plugin_name.".php")){
			include("modules/".$plugin_name."/".$plugin_name.".php");
		}
	}
		
	//----------------//
	include('functions/load/template.php');
	repopulateform($_POST);
	$al_url = basename($_SERVER['REQUEST_URI']);
	if(substr_count($al_url, '\?')){ detectEmptyParameter($al_url);}
	$al_site_title = '';
	load_template($al_connexion, $al_site_title, load_modules($al_connexion, $al_page, $al_id, $al_action), $al_page);
	$_SESSION['error_message'] = '';
	
?>