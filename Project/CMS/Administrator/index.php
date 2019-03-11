<?php

ini_set('display_errors', 0);
require '../../../vendor/autoload.php';
define("SIDE", '/Administrator');

if (file_exists('../config.php')) {
    include('../config.php');
	define("HASH", $prefix_table);
} else {
    die('The config file dosen\'t exist !');
}

if(!empty($timezone)){ date_default_timezone_set($timezone); }
$session_domain = !empty($session_domain) ? $session_domain : $_SERVER['SERVER_NAME'];
$session_time = !empty($session_time) ? $session_time : '0';
$session_path = !empty($session_path) ? $session_path : '/';
session_set_cookie_params($session_time, $session_path, $session_domain);
session_start();

$_SESSION['Admin'] = "";
$_SESSION['Site'] = "";
$_SESSION['editor'] = $editor;
$_SESSION['lang'] = isset($_SESSION['lang']) ? $_SESSION['lang'] : "en";

$container = new stdClass();
// Connexion and Data
$container->system_connexion = new \CMS\Administrator\Functions\Database\Database($al_db_name, $al_user, $al_password, $al_host);
$container->data = new \CMS\Libraries\Classes\Container\Data($container);

// Load libraries
$libraries = new \CMS\Libraries\Libraries($container);
$libraries->load_standard();
$libraries->load_extended();
$libraries->load_container();

// Actions
$container->system_repopulate->repopulateform($_POST);
$config = $container->system_config->loadconfig();
$container->security->security_admin($config);

$modules = new \CMS\Administrator\Functions\Load\Module($container);
$template = new \CMS\Administrator\Functions\Load\Template($modules->load_modules(), $container);
return $template->render();
?>