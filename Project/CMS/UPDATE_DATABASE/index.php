<?php

if(file_exists("../config.php")){
	include "../config.php";
}
elseif(file_exists("../vendor/CMS/config.php")) {
	include "../vendor/CMS/config.php";
}

if(!empty($prefix_table)){
	$prefix = $prefix_table;
}
else {
	$prefix = HASH;
}

$al_link = mysqli_connect($al_host,$al_user,$al_password,$al_db_name);
if (!$al_link){ die("Failed to connect to MySQL: " . mysql_error()); }
mysqli_set_charset($al_link, 'utf8');

$tables = array(
	$prefix."_link_menu:1" => "published:INT(10) NOT NULL:1",
	$prefix."_link_menu:2" => "sub_menu:INT(10) NOT NULL:",
	$prefix."_modules:3" => "content:longtext NOT NULL:",
	$prefix."_modules:4" => "username:VARCHAR(255) DEFAULT NULL:",
	$prefix."_modules:5" => "article,comment,contact,counter,custom,gallery,menu",
	$prefix."_articles:6" => "article"
);

$conversion = array(
	'contacts' => 'contacts',
	'comments' => 'article',
	'category' => 'category',
	'article' => 'article',
	'gallery' => 'gallery',
	'counter' => 'counter'
);

$conversion_second = array(
	'contacts' => array('show_title', 'show_first_name', 'show_last_name', 'show_email', 'show_phone', 'show_postal_code', 'show_city', 'show_state', 'show_country', 'show_daybirth', 'show_monthbirth', 'show_yearbirth', 'show_gender', 'show_content'),
	'comments' => array('show_title', 'show_description', 'show_username', 'show_time', 'show_date'),
	'article' => array('show_title', 'show_description', 'show_username', 'show_time', 'show_date'),
	'gallery' => array('show_title', 'show_description', 'show_username', 'show_time', 'show_date'),
	'category' => array('show_title'),
	'counter' => array('show_title')
);

$message = "";

mysqli_query($al_link, "TRUNCATE TABLE ".$prefix."_plugins");
$sql = "INSERT INTO ".$prefix."_plugins (id, title, date, time, default_shortcut, content, publish) VALUES
(8,	'Article',	'2014-09-09',	'01:50:46',	'_add_module',	'article',	1),
(9,	'Custom',	'2014-09-09',	'01:50:46',	'_add_module',	'custom',	1),
(10,	'Language',	'2014-09-09',	'01:50:46',	'_add_module',	'language',	1),
(246,	'Gallery',	'2016-09-03',	'01:36:49',	'gallery_listed',	'gallery',	1),
(245,	'Counter',	'2016-09-03',	'01:36:44',	'counter_listed',	'counter',	1),
(243,	'Comments',	'2016-09-03',	'01:36:38',	'comment_listed_comments',	'comment',	1),
(244,	'Contact',	'2016-09-03',	'01:36:41',	'contact_listed',	'contact',	1),
(237,	'Menu',	'2014-09-09',	'01:50:46',	'_add_module',	'menu',	1)";
mysqli_query($al_link, $sql);

$sql = "INSERT INTO ".$prefix."_modules (id, title, category, modules, order1, date, time, shortcut, position, content, published, username) VALUES
(59,	'hidden',	'hidden',	'{\"type_menu\":{\"category\":{\"show_title\":\"show_title\"}}}',	'',	'',	'',	'all',	'',	'',	0,	NULL)";
mysqli_query($al_link, $sql);

foreach($tables as $key => $value){
	if($key == $prefix."_modules:5" || $key == $prefix."_articles:6"){
		$key2 = explode(':', $key);
		$value = explode(',', $value);
		
		foreach ($value as $index => $type) {			
			if($key == $prefix."_articles:6"){
				$rows = mysqli_query($al_link, "SELECT id, modules FROM ".$key2[0]);
			} else {
				$rows = mysqli_query($al_link, "SELECT id, modules FROM ".$key2[0]." WHERE modules LIKE '%type_".$type."%'");
			}
			
			while ($row = mysqli_fetch_array($rows, MYSQLI_ASSOC)) {
				$json = $row["modules"];
				
				////// CONVERT OLD STRING DATABASE
				$get_result = json_decode(html_entity_decode($json));
				if(json_last_error() != JSON_ERROR_NONE){
					$build = array();
					
					if($key == $prefix."_articles:6"){
						$json = '{'.$json.'}';
					}
					if (preg_match('/\{(.*?)\}$/', $json, $al_match)) {
						$get_type = explode('{', $al_match[1]);
						if($key == $prefix."_articles:6"){
							$get_type = 'type_article';
						}
						if (preg_match('/\{(.*?)\}$/', $al_match[1], $al_match2)) {
							foreach($conversion as $old => $new){
								if (preg_match('/'.$old.'\{(.*?)\}/', $al_match2[1], $al_match3)) {
									$items = explode(':', $al_match3[1]);
									$i = 0;
									foreach ($conversion_second[$old] as $key3 => $value) {
										if($key == $prefix."_articles:6"){
											$build[$get_type][$new][$value] = empty($items[$i]) ? "0" : $items[$i];
										} else {
											if($old == 'comments'){
												$build['type_comment']['category']['show_title'] = 'show_title';
											}
											$build[$get_type[0]][$new][$value] = $items[$i];
										}
										$i++;
									}
								}
							}
						}
					}
					
					$json = json_encode($build);
				}
				
				//////////////////////////////////
				if($json != $row["modules"]){
					$sql = "UPDATE ".$key2[0]."
					SET modules = '".$json."'
					WHERE id = ".$row['id'];
					mysqli_query($al_link, $sql);
				}
			}
		}
		
	$message .= $key2[0]." sucessfully updated<br />";
		
	} else {
		$info = explode(':', $value);
		$key2 = explode(':', $key);
		$key = $key2[0];
		$col = mysqli_query($al_link, "SELECT ".$info[0]." FROM ".$key);
		
		if (!$col){	
			mysqli_query($al_link, "ALTER TABLE ".$key." ADD ".$info[0]." ".$info[1]);
		
			$message .= $info[0]." has been added to the database<br />";
	
			if(!empty($info[2])){	
				mysqli_query($al_link, "UPDATE ".$key." SET ".$info[0]."='".$info[2]."'");
			}		
		} else {
			$message .= $info[0]." already exists<br />";
		}
	}
}
echo $message;
echo"<br />UPDATE COMPLETED";

?>