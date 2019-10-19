<?php

namespace CMS\Administrator\Modules\Media;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Media extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function media() {
		$system_config = $this->system_config;
        $this->system_view->init('Media', 'Media');
		$this->system_view->assign('plugins', $this->container->system_plugins->check_plugin());
		$this->system_view->assign('system_config', $system_config);
        return $this->system_view->render();
    }

    public function media_show() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		if(empty($get['folder'])){
			$folder = '../Media';
		} else {
			$folder = $get['folder'];
		}
        $this->system_view->init('Media', 'ShowMedia');
		$this->system_view->assign('folder', $folder);
        return $this->system_view->render();
    }
	
	public function process_media() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$images = $post['images'];
        foreach ($images as $key => $value) {
            unlink($value);
        }
		
		$new_folder = $post['new_folder'];
		$old_path = $post['old_path'];
		$copy = $post['copy'];
        foreach ($new_folder as $key => $value) {
			if(!isset($images[$key])){
				if($copy[$key] == '1'){
					copy($old_path[$key], $value);
				} else {
					rename($old_path[$key], $value);
				}
			}
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

?>