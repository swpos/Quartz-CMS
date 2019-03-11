<?php
	function add_plugins($al_connexion) {
		return render(array('al_connexion' => $al_connexion), 'plugins', 'add_plugin');
	}
	
	function rrmdir($dir) {
		foreach(glob($dir . '/*') as $file) {
			if(is_dir($file))
				rrmdir($file);
			else
				unlink($file);
		}
		rmdir($dir);
	}
	
	function delete_plugins ($al_connexion){
		$al_id = decoding((isset($_GET['id_plugin']) ? $_GET['id_plugin'] : ''));
		$select1=$al_connexion->prepare("SELECT * FROM ".HASH."_plugins WHERE id = :al_id");
		$select1->bindParam(':al_id', $al_id);
		$select1->execute();
		$select1->setFetchMode(PDO::FETCH_OBJ);
		$al_fetch_plugins = $select1->fetch();
		$plugin_name = $al_fetch_plugins->content;
		include("modules/".$plugin_name."/links.php");
		
		foreach($tables as $key => $value){
			$select1=$al_connexion->prepare("DROP TABLE ".$value);
			$select1->execute();
		}
		
		rrmdir("modules/".$plugin_name);
		rrmdir("../modules/".$plugin_name);
		
		$select1=$al_connexion->prepare("DELETE FROM ".HASH."_plugins WHERE id='$al_id'");
		$select1->execute();
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit;
	}
	
	function publish_plugins ($al_connexion) {
		$al_id=decoding((isset($_GET['id_plugin']) ? $_GET['id_plugin'] : ''));
		$al_state=decoding((isset($_GET['state']) ? $_GET['state'] : ''));
		if($al_state=='Yes'){$al_enable=0;}else{$al_enable=1;}
		
		$update_plugin = $al_connexion->prepare("UPDATE ".HASH."_plugins SET publish=? WHERE id=?");
		$update_plugin->execute(array($al_enable,$al_id));
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}
	
	function plugins ($al_connexion){		
		$al_search=encoding((isset($_POST['search_plugin']) ? $_POST['search_plugin'] : ''));
		$al_title=encoding((isset($_POST['title_plugin']) ? $_POST['title_plugin'] : ''));
		$al_time=encoding((isset($_POST['time_plugin']) ? $_POST['time_plugin'] : ''));
		$al_date=encoding((isset($_POST['date_plugin']) ? $_POST['date_plugin'] : ''));
		$al_published=encoding((isset($_POST['published_plugin']) ? $_POST['published_plugin'] : ''));
		$al_post_order=encoding((isset($_POST['post_order_plugin']) ? $_POST['post_order_plugin'] : ''));
		$buildQuery = '';
		
		if($al_search || $al_published){	
			$order="WHERE";
			$order1=array();
			
			if($al_search){
				$order1[].=" title LIKE '%".$al_search."%'";
			}
			if($al_published){
				if($al_published=='yes'){$al_published="1";}
				else{$al_published="0";}
				$order1[].=" publish = '".$al_published."'";
			}
			$buildQuery.=$order.implode(" AND ",$order1);
		}
	
		if($al_title || $al_time || $al_date){
			$order=	" ORDER BY";
			$order2=array();
			if($al_title){
				$order2[].=" title ".$al_title;
			}
			if($al_time){
				$order2[].=" time ".$al_time;
			}
			if($al_date){
				$order2[].=" date ".$al_date;
			}
			$buildQuery.=$order.implode(", ",$order2);
		}
		if(isset($_POST['post_order_plugin'])){
			$_SESSION['order_plugin_query'] = $buildQuery;
		} else {
			$buildQuery = isset($_SESSION['order_plugin_query']) ? $_SESSION['order_plugin_query'] : '';
		}
		$select1=$al_connexion->query("SELECT * FROM ".HASH."_plugins $buildQuery LIMIT ".get_pagination());
		$select1->setFetchMode(PDO::FETCH_OBJ);
		
		$select2=$al_connexion->query("SELECT * FROM ".HASH."_plugins");
		$al_init_plugins_rows = $select2->rowCount();
		
		return render(array('al_connexion' => $al_connexion, 'select1' => $select1, 'al_init_plugins_rows' => $al_init_plugins_rows), 'plugins', 'plugins_list');
	}
		
	function cpy($source, $dest){
		if(is_dir($source)) {
			$dir_handle=opendir($source);
			while($file=readdir($dir_handle)){
				if($file!="." && $file!=".."){
					if(is_dir($source."/".$file)){
						mkdir($dest."/".$file);
						cpy($source."/".$file, $dest."/".$file);
					} else {
						copy($source."/".$file, $dest."/".$file);
					}
				}
			}
			closedir($dir_handle);
		} else {
			copy($source, $dest);
		}
	}
		
	function unzip($source, $destination) {
		@mkdir($destination, 0777, true);
		$zip = new \ZipArchive;
		if ($zip->open(str_replace("//", "/", $source)) === true) {
			$zip->extractTo($destination);
			$zip->close();
		}
	}
	
	function run_sql_file($al_connexion,$location){
		$commands = file_get_contents($location);
		$lines = explode("\n",$commands);
		$commands = '';
		foreach($lines as $line){
			$line = trim($line);
			if( $line && !startsWith($line,'--') ){
				$commands .= $line . "\n";
			}
		}
		$commands = explode(";", $commands);
		foreach($commands as $command){
			if(trim($command)){
				$select1=$al_connexion->prepare($command);
				$select1->execute();
			}
		}
	}

	function startsWith($haystack, $needle){
		$length = strlen($needle);
		return (substr($haystack, 0, $length) === $needle);
	}
	
	
	function upload_plugins ($al_connexion){
		$al_content_display = '';
		$al_content_display .=buildMenu($al_connexion);
		$temp = explode(".", $_FILES["upload"]["name"]);
		if (end($temp)=='zip') {
			$al_content_display.="Upload: " . $_FILES["upload"]["name"] . "<br>";
			$al_content_display.="Type: " . $_FILES["upload"]["type"] . "<br>";
			$al_content_display.="Size: " . ($_FILES["upload"]["size"] / 1024) . " kB<br>";
			$al_content_display.="Temp file: " . $_FILES["upload"]["tmp_name"] . "<br>";
			if (file_exists("cache/".$_FILES["upload"]["name"])){
				$al_content_display.= $_FILES["upload"]["name"] . " already exists. ";
			}
			else{
				move_uploaded_file($_FILES["upload"]["tmp_name"],"cache/" . $_FILES["upload"]["name"]);
			}
				if(file_exists("cache/".$_FILES["upload"]["name"])){
					$al_content_display.= "Stored in: " . "administrator/cache/" . $_FILES["upload"]["name"];
					unzip("cache/".$_FILES["upload"]["name"], "cache/".$temp[0]);	
					$al_content_display.="<br />Copying files...";
					
					if(is_dir("cache/".$temp[0]."/".$temp[0])){
						cpy("cache/".$temp[0]."/".$temp[0]."/administrator/modules", "modules");
						cpy("cache/".$temp[0]."/".$temp[0]."/modules", "../modules");
						$file_content = "cache/".$temp[0]."/".$temp[0]."/tables.sql";
						$config_file="cache/".$temp[0]."/".$temp[0]."/config.php";
					}
					else {
						cpy("cache/".$temp[0]."/administrator/modules", "modules");
						cpy("cache/".$temp[0]."/modules", "../modules");
						$file_content = "cache/".$temp[0]."/tables.sql";
						$config_file="cache/".$temp[0]."/config.php";
					}
					
					if(is_dir("modules/".$temp[0]) && is_dir("../modules/".$temp[0])){
						if($file_content){
							run_sql_file($al_connexion,$file_content);
							$al_content_display.="<br />Executing SQL of table file...";
						}
						else {
							$al_content_display.="<br />Error! did not found the tables.sql file at the root";
						}
						
						if(file_exists($config_file)){
							include($config_file);
							$al_date = date('Y-m-d');
							$al_time = date('H:i:s');
							
							$query1 = $al_connexion->prepare("INSERT INTO ".HASH."_plugins (title, date, time, default_shortcut, content, publish) VALUES(:title, :date, :time, :default_shortcut, :content, :publish)");
							$query1->execute(
								array(
								':title'=>$al_title,
								':date'=>$al_date,
								':time'=>$al_time,
								':default_shortcut'=>$al_default_shortcut,
								':content'=>$al_module_name,
								':publish'=>'1'
								)
							);
						}
						else {
							$al_content_display.="<br />Error! did not found the config.php file at the root";
						}
					}
					else{
						$al_content_display.="Error copying files ! : This may be because the files are in many subfolders. Verify that the files are in only one folder inside the zip file (with the same name 'without .zip extension'), OR at the root of the zip file.<br /><br />This may also be because the permission on the modules folders are not set temporarily to chmod 777";
					}
				}
				else {
					$al_content_display.="Error uploading the zip file. This may be because the permission on the administrator/cache folder are not set to chmod 777.";
				}
		}
		
		return $al_content_display;
	}	
?>