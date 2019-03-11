<?php

namespace CMS\Administrator\Modules\Plugin;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Plugin extends ModuleExtended {
	
    public function __construct($container) {
		parent::__construct($container);
    }

    public function plugin_add() {
        $this->system_view->init('Plugin', 'AddPlugin');
        return $this->system_view->render();
    }

    public function plugin_delete() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$listed = $this->system_model->init("Plugin", "Listed");
		$plugins = $listed->getPluginById(['id' => $get['id_plugin']]);

        $name = ucfirst($plugins->content);
        include("Modules/" . $name . "/Links.php");

        foreach ($tables as $key => $value) {
			$listed->deletePluginTable(['value' => $value]);
			$entity = str_replace('cms', '', $value);
			$entity = str_replace('_', '', $entity);
			
			if (file_exists("../Languages/Tables/" . ucfirst($entity) . ".php")) {
				unlink("../Libraries/Tables/" . ucfirst($entity) . ".php");
			}     
        }
		
		if(is_dir("Modules/" . $name)){
        	$this->v->rrmdir("Modules/" . $name);
		}
		
		if(is_dir("../Modules/" . $name)){
        	$this->v->rrmdir("../Modules/" . $name);
		}
		
		if(is_dir("../Plugins/" . $plugins->content)){
        	$this->v->rrmdir("../Plugins/" . $plugins->content);
		}
		
        if (file_exists("../Languages/Admin/En/" . $name . ".php")) {
            unlink("../Languages/Admin/En/" . $name . ".php");
        }
		
        if (file_exists("../Languages/Admin/Fr/" . $name . ".php")) {
            unlink("../Languages/Admin/Fr/" . $name . ".php");
        }
		
        if (file_exists("../Languages/Site/En/" . $name . ".php")) {
            unlink("../Languages/Site/En/" . $name . ".php");
        }
		
        if (file_exists("../Languages/Site/Fr/" . $name . ".php")) {
            unlink("../Languages/Site/Fr/" . $name . ".php");
        }

		$listed->deletePlugin(['id' => $get['id_plugin']]);
    }

    public function plugin_publish() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$enable = ($get['state'] == '1') ? 0 : 1;
		
		$info = [
			'data' => ['publish' => $enable],
			'where' => ['id' => $get['id_plugin']]
		];
		$listed = $this->system_model->init("Plugin", "Listed");
		$listed->updatePlugin($info);
    }

    public function plugin_listed() {
		$get = $this->v->_gA();
		$post = $this->v->_pA(['search_plugin', 'title_plugin', 'time_plugin', 'date_plugin', 'published_plugin', 'post_order_plugin']);
		
		$info = [
			'al_search' => $post['search_plugin'],
			'al_title' => $post['title_plugin'],
			'al_time' => $post['time_plugin'],
			'al_date' => $post['date_plugin'],
			'al_published' => $post['published_plugin'],
			'al_post_order' => $post['post_order_plugin']
		];
		$listed = $this->system_model->init("Plugin", "Listed");
		$plugins = $listed->pluginsList($info);		

        $this->system_view->init('Plugin', 'PluginList');
        $this->system_view->assign('al_fetch_plugins', $plugins['rows']);
        $this->system_view->assign('al_init_plugins_rows', $plugins['total']);
        return $this->system_view->render();
    }

    public function run_sql_file($location) {
        $commands = file_get_contents($location);
        $lines = explode("\n", $commands);
        $commands = '';
		
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line && !$this->v->startsWith($line, '--')) {
                $commands .= $line . "\n";
            }
        }
		
        $commands = explode(";", $commands);
		$add = $this->system_model->init("Plugin", "Add");
		
        foreach ($commands as $command) {
            if (trim($command)) {
				$add->run_sql_file_unknown(['command' => $command]);
            }
        }
    }

	public function get_config_file($path) {
		$zip = zip_open($path);
		if ($zip){
			while ($entry = zip_read($zip)){				
				if(!is_dir(zip_entry_name($entry)) && strtolower(basename(zip_entry_name($entry))) == "_config_install.php"){					
					$file = zip_entry_name($entry);
					return "zip://".$path."#".$file;					
				}
			}
			zip_close($zip);
			
			return "config_file";
		}
	}

	public function get_subdirectory($folder) {	
		if(isset($folder) && !empty($folder)) {
			$slash = explode('/', $folder);
			if(end($slash)==""){
				return $folder;
			}
			else {
				return $folder."/";
			}
		}
	}

    public function plugin_upload() {
        $content = '';
        $temp = explode(".", $_FILES["upload"]["name"]);
		
        if (end($temp) == 'zip') {
            $content .= UPLOAD_PLUGIN_UPLOAD . $_FILES["upload"]["name"] . "<br />";
            $content .= UPLOAD_PLUGIN_TYPE . $_FILES["upload"]["type"] . "<br />";
            $content .= UPLOAD_PLUGIN_SIZE . ($_FILES["upload"]["size"] / 1024) . " kB<br />";
            $content .= UPLOAD_PLUGIN_TEMP_FILE . $_FILES["upload"]["tmp_name"] . "<br />";
			
            if (file_exists("Cache/" . $_FILES["upload"]["name"])) {
                $content .= $_FILES["upload"]["name"] . " already exists. ";
            } else {
                move_uploaded_file($_FILES["upload"]["tmp_name"], "Cache/" . $_FILES["upload"]["name"]);
            }
			
            if (file_exists("Cache/" . $_FILES["upload"]["name"])) {
                $content .= UPLOAD_PLUGIN_STORED_IN . $_FILES["upload"]["name"];
                $this->v->unzip("Cache/" . $_FILES["upload"]["name"], "Cache/" . $temp[0]);
                $content .= UPLOAD_PLUGIN_COPYING_FILES;
				
				//this line include the config file
				$config = $this->get_config_file("Cache/".$temp[0].".zip");
				
				if(!empty($config) && ($config != "config_file")){
					include $config;
					
					if(isset($zip_main_folder)){
						$subdirectory = $this->get_subdirectory($zip_main_folder);
						$copy = "Cache/".$temp[0]."/".$subdirectory;
						
						if((count($folders) > 0) && isset($folders)){
							foreach($folders as $key => $value){
								$slash = explode('/', $value);
								
								if(count($slash) > 1) {
									$content .= UPLOAD_PLUGIN_WARNING_FOLDER_ENTRY_1." $value ".UPLOAD_PLUGIN_WARNING_FOLDER_ENTRY_2;
								} else {
									if(is_dir($copy.$value) || file_exists($copy.$value)){						
										$this->v->cpy($copy.$value, "../".$value);
									}
									else {
										$content .= UPLOAD_PLUGIN_FOLDER_NOT_DIR_1." $value ".UPLOAD_PLUGIN_FOLDER_NOT_DIR_2;
									}
								}
							}
							
							$sql_file = $copy."tables.sql";
							
							if(!empty($al_module_name)){
								if (is_dir("Modules/" . ucfirst($al_module_name)) && is_dir("../Modules/" . ucfirst($al_module_name))) {
									if ($sql_file) {
										$this->run_sql_file($sql_file);
										$content .= UPLOAD_PLUGIN_EXECUTING_SQL;
									} else {
										$content .= UPLOAD_PLUGIN_DID_NOT_FOUND_SQL;
									}
				
									if (isset($al_default_shortcut) && isset($al_module_name) && isset($al_title)) {
										if(!empty($al_module_name) && !empty($al_title)){
											$info = [
												':title' => $al_title,
												':date' => date('Y-m-d'),
												':time' => date('H:i:s'),
												':default_shortcut' => $al_default_shortcut,
												':content' => $al_module_name,
												':publish' => '1'
											];
											
											$add = $this->system_model->init("Plugin", "Add");
											$add->pluginUpload($info);
										}
										else {
											$content .= UPLOAD_PLUGIN_NO_ENTRY_WILL_BE_CREATED;	
										}
									} else {
										$content .= UPLOAD_PLUGIN_DID_NOT_CONFIG_FILE;
									}
								} else {
									$content .= UPLOAD_PLUGIN_ERROR_COPYING_FILES;
								}
							}
						}
						else {
							$content .= UPLOAD_PLUGIN_NO_FOLDERS_ARRAY;
						}
					}
					else {
						$content .= UPLOAD_PLUGIN_MAIN_DIRECTORY_VAR;
					}
				}
				else {
					$content .= UPLOAD_COULD_NOT_FOUND_CONFIG_FILE_PLUGIN;
				}
            } else {
                $content .= UPLOAD_PLUGIN_ERROR_UPLOADING_ZIP;
            }
        }

        return $content;
    }

}

?>