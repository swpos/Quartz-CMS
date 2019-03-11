<?php

namespace CMS\Libraries\Classes\Standard;

class Variables {

    public function d(&$isset) {
		return isset($isset) ? $isset : "";
	}
	
	public function e(&$isset) {
		return htmlspecialchars($this->d($isset), ENT_QUOTES);
	}
	
	public function _g($isset) {
		return $this->d($_GET[$isset]);
	}
	public function _s($isset) {
		return $this->d($_SESSION[$isset]);
	}
	public function _p($isset) {
		return $this->d($_POST[$isset]);
	}
	
	public function _gA($autodefine = []) {
		$build = [];
		foreach ($_GET as $key => $value) {
			$build[$key] = isset($value) ? $value : "";	
		}
		
		foreach ($autodefine as $key => $value) {
			$build[$value] = isset($_GET[$value]) ? $_GET[$value] : "";	
		}
		
		return $build;
	}
	
	public function _sA($autodefine = []) {
		$build = [];
		foreach ($_SESSION as $key => $value) {
			$build[$key] = isset($value) ? $value : "";
		}
		
		foreach ($autodefine as $key => $value) {
			$build[$value] = isset($_SESSION[$value]) ? $_SESSION[$value] : "";	
		}
		
		return $build;
	}
	
	public function _pA($autodefine = []) {
		$build = [];
		foreach ($_POST as $key => $value) {
			$build[$key] = isset($value) ? $value : "";
		}
		
		foreach ($autodefine as $key => $value) {
			$build[$value] = isset($_POST[$value]) ? $_POST[$value] : "";	
		}
		
		return $build;
	}
	
	public function d_a($array) {
		return (is_array($array) ? $array : [$array]);
	}
	
	public function substr_count_array($al_string, $al_array) {
        $al_count = 0;
        foreach ($al_array as $al_value) {
            if ($al_value == $al_string) {
                $al_count++;
            }
        }
        return $al_count;
    }
	
	public function rrmdir($dir) {
        foreach (glob($dir . '/*') as $file) {
            if (is_dir($file))
                $this->rrmdir($file);
            else
                unlink($file);
        }
        rmdir($dir);
    }
	
	public function cpy($source, $dest) {
        if (is_dir($source)) {
            $dir_handle = opendir($source);
            while ($file = readdir($dir_handle)) {
                if ($file != "." && $file != "..") {
                    if (is_dir($source . "/" . $file)) {
                        if(!file_exists($dest . "/" . $file)){
							mkdir($dest . "/" . $file);
						}
                        $this->cpy($source . "/" . $file, $dest . "/" . $file);
                    } else {
                        copy($source . "/" . $file, $dest . "/" . $file);
                    }
                }
            }
            closedir($dir_handle);
        } else {
            copy($source, $dest);
        }
    }
	
	public function unzip($source, $destination) {
        @mkdir($destination, 0777, true);
        $zip = new \ZipArchive();
        if ($zip->open(str_replace("//", "/", $source)) === true) {
            $zip->extractTo($destination);
            $zip->close();
        }
    }
	
	public function startsWith($haystack, $needle) {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
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
	
}

?>