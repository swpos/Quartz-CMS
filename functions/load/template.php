<?php
	function load_modules($al_connexion,$al_shortcut, $al_action, $al_id, $al_pseudo){
		$al_article_real=array();	
		$al_article2=array();
		$al_plugins_main=array();
		$al_menu2=array();
		$al_plugins_array=array();
		
		$select4=$al_connexion->query("SELECT * FROM ".HASH."_articles WHERE publish='1' ORDER BY order1");
		$select4->setFetchMode(PDO::FETCH_OBJ);
		
		while($al_fetch_article = $select4->fetch()){	
			$al_id_article=decoding($al_fetch_article->id);
			$al_shortcut_multiple=decoding($al_fetch_article->shortcut);	
			
			if($al_shortcut=="0"){
				$al_shortcut='index';
			}
			
			$al_shortcut_array=explode(':', $al_shortcut_multiple);
			if(in_array($al_shortcut, $al_shortcut_array)){
				$al_article_real_content=load_article_real($al_connexion, $al_id_article);
				if($al_article_real_content){
					$al_article_real[$al_id_article.'-article_component'] = $al_article_real_content;
				}
			}	
		}
		
		
		$select1=$al_connexion->query("SELECT * FROM ".HASH."_plugins WHERE publish='1'");
		$select1->setFetchMode(PDO::FETCH_OBJ);
		
		while($al_fetch_plugins = $select1->fetch()){
			$plugin_name=$al_fetch_plugins->content;
			$al_plugins_array[]=$plugin_name;
			include("modules/".$plugin_name."/config.php");
		}
	
		$al_i=0;
		$select2=$al_connexion->query("SELECT * FROM ".HASH."_modules WHERE published='1' ORDER BY order1");
		$select2->setFetchMode(PDO::FETCH_OBJ);
		
		while($al_fetch_modules = $select2->fetch()){	
			$al_id_module=decoding($al_fetch_modules->id);
			$al_modules_decorticate=decoding($al_fetch_modules->modules);
			$al_position=decoding($al_fetch_modules->position);
			$al_category=decoding($al_fetch_modules->category);
			$al_title_module=decoding($al_fetch_modules->title);
			$al_shortcut_multiple=decoding($al_fetch_modules->shortcut);	
			
			if($al_shortcut=="0"){
				$al_shortcut='index';
			}
			$al_shortcut_array=explode(':', $al_shortcut_multiple);
			
			if($al_position!=''){
				if(in_array($al_shortcut, $al_shortcut_array) || in_array("all", $al_shortcut_array)){
					if(preg_match('/\{(.*?)\}$/', $al_modules_decorticate, $al_match)) {            			
						if(substr_count($al_match[1], 'type_article')){
							$al_article=load_article($al_connexion, $al_category, $al_id_module, $al_match[1], $al_shortcut, $al_title_module, 'none', 'no');
							
							if($al_article){
								$al_article2[$al_id_module.'-'.$al_position] = $al_article;
							}				
						}
						
						if(substr_count($al_match[1],'type_menu')){
							$al_menu=load_menu($al_connexion, $al_id_module, $al_match[1], $al_shortcut);
							
							if($al_menu){
								$al_menu2[$al_id_module.'-'.$al_position] = $al_menu;
							}
						}
						
						preg_match('/\{type_(.*?)\{/', $al_modules_decorticate, $al_get_custom_type);
						
						if(in_array($al_get_custom_type[1], $al_plugins_array)){
							$functioname="load_".$al_get_custom_type[1];
							$al_plugin_function=$functioname($al_connexion, $al_id_module, $al_shortcut, $al_match[1]);
							if($al_plugin_function){
								$al_plugins_main["al_".$al_get_custom_type[1]][$al_id_module.'-'.$al_position] = $al_plugin_function;
							}
						}
					}
				}
			}
			$al_i++;
		}
		
		
		
		$al_tableau[]=$al_article_real;
		$al_tableau[]=$al_article2;
		$al_tableau[]=$al_menu2;
		foreach($al_plugins_main as $value){
			$al_tableau[]=$value;
		}
		return $al_tableau;
	}

	function load_template ($al_connexion,$al_site_title,$al_tableau,$al_title_page){
		foreach($al_tableau as $al_values){
			foreach($al_values as $al_position => $al_content){
				$al_position1=explode('-',$al_position);
				
				if(!isset(${$al_position1[1]})){ ${$al_position1[1]} = ''; }
				
				${$al_position1[1]} .= $al_content;
			}
		}
				
		$al_site_title = loadvariable($al_connexion); 
		$al_title_page = loadtitle($al_connexion,$al_title_page); 
		$templatetitle = loadtemplatetitle($al_connexion);
		$al_title_template = $templatetitle;
		
		include('templates/'.$templatetitle.'/index.php');
	}
?>