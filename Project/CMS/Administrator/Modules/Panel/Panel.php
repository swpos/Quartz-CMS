<?php

namespace CMS\Administrator\Modules\Panel;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Panel extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function panel() {
        $this->system_view->init('Panel', 'Panel');
        return $this->system_view->render();
    }
	
	public function countfile (){
		$i = 0; 
		$dir = 'Cache/';
		if ($handle = opendir($dir)) {
			while (($file = readdir($handle)) !== false){
				if (!in_array($file, ['.', '..']) && !is_dir($dir.$file)) $i++;
			}
		}
		
		return $i;
	}
	
	public function recursiveDelete($str){
        if(is_file($str)) {
            return @unlink($str);
        } elseif(is_dir($str)) {
            $scan = glob(rtrim($str,'/').'/*', GLOB_BRACE);
			
            foreach($scan as $index => $path){
                $this->recursiveDelete($path);
            }
			
			if($this->countfile() != 0) {
				return @rmdir($str);
			}
        }
    }
	
	public function clear_cache() {
		$this->recursiveDelete('Cache/');
    }
}

?>