<?php

namespace CMS\Libraries\Classes\Standard;

class Validation {
	
	public function format_link($al_txt_string = null) {
        $al_txt = str_replace("'", "_", $al_txt_string);
        $al_txt = str_replace("\"", "_", $al_txt);
        $al_txt = str_replace("&#39;", "_", $al_txt);
        $al_txt = str_replace("&quot;", "_", $al_txt);
        $al_transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'â' => 'a', 'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ä' => 'ae', 'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ç' => 'c', 'Ç' => 'C', 'Ð' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ê' => 'e', 'Ê' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ƒ' => 'f', 'ƒ' => 'F', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I', 'ñ' => 'n', 'Ñ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ö' => 'oe', 'Ö' => 'OE', 'š' => 's', 'Š' => 'S', 'ß' => 'SS', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'û' => 'u', 'Û' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ý' => 'y', 'Ý' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ž' => 'z', 'Ž' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u');
        $al_txt = str_replace(array_keys($al_transliterationTable), array_values($al_transliterationTable), html_entity_decode($al_txt));
        $al_txt = preg_replace_callback("/[^a-zA-Z0-9]/", function() {
            return "_";
        }, $al_txt);
        return $al_txt;
    }
	
	public function treatAsUrl($url, $type, $module) {
		$url_store = $url;
		$url = str_replace('https','', $url);
		$url = str_replace('http','', $url);
		$url = str_replace(':','', $url);
		$array_of_url = explode('/', $url);
		$next_array = [];
		foreach($array_of_url as $key => $value){
			if(!empty($value) && $value != "https" && $value != "http"){
				$next_array[] = $value; 
			}
		}
		$url = implode('/', $next_array);
		if (strpos($url_store,'https') !== false){
			$url = "https://".$url."/";
		} else {
			$url = "http://".$url."/";
		}			
		return $url;
	}
	
	public function infectType($array, $type, $module){
		if(is_array($array)){
			return json_encode($array);
		} else {
			return json_encode(array($array));
		}
	}
	
	public function object_to_array($obj) {
		if(is_object($obj)) $obj = (array) $obj;
		if(is_array($obj)){
			$new = array();
			foreach($obj as $key => $val) {
				$new[$key] = $this->object_to_array($val);
			}
		} else {
			$new = $obj;
		}
		return $new;       
	}
	
	public function prepare_options($array, $type, $module) {
		$dir =  dirname($_SERVER['PHP_SELF']);
		$dirs = explode('/', $dir);
		$side = strtolower($dirs[1]);
		
		if($side == 'administrator'){
			$XML_DATA = file_get_contents('Modules/'.ucfirst($module).'/'.ucfirst($module).'.xml', true);
		} else {
			$XML_DATA = file_get_contents('Administrator/Modules/'.ucfirst($module).'/'.ucfirst($module).'.xml', true);
		}
		
		$structure = $this->object_to_array(simplexml_load_string($XML_DATA));
		$build = [];
		
		foreach ($structure[$type]['modules']['value'] as $name => $options) {
			foreach ($options as $key => $value) {
				$build[$name][$key] = (string) $array[$name][$key];
			}
		}	
			
		$result = ['type_'.$module => $build];		
		return json_encode($result);
	}
	
	public function valid_module($params, $type, $module) {
		$prepare_options = $this->prepare_options($params, $type, $module);
		return $prepare_options;
	}
	
	public function valid_shortcut($shortcut, $type, $module) {
		if(is_array($shortcut)){
			if (in_array("all", $shortcut)) {
				return "all";
			} else {
				return implode(':', $shortcut);
			}
		} else {
			return $shortcut;
		}
	} 
	
	public function valid_category($category, $type, $module) {
		$formatted = $this->format_link($category);
		return $formatted;
	}
	
	public function valid_link($link, $type, $module) {
		$formatted = $this->format_link($link);
		return $formatted;
	}
}

?>