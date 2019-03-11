<?php

namespace CMS\Administrator\Modules\Media;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Media extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function media() {
        $this->system_view->init('Media', 'Media');
		$this->system_view->assign('plugins', $this->container->system_plugins->check_plugin());
        return $this->system_view->render();
    }

    public function media_show() {
		$dir = '../Media/thumbnail';
		if(file_exists($dir)){
        	$folders = scandir($dir);
		} else {
			$folders = array();
		}
        $this->system_view->init('Media', 'ShowMedia');
		$this->system_view->assign('al_get_folders', $folders);
        $this->system_view->assign('al_dir', $dir);
        return $this->system_view->render();
    }
	
	public function delete_media() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$images = $post['images'];
        foreach ($images as $key => $value) {
            unlink('../Media/' . $value);
            unlink('../Media/thumbnail/' . $value);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

?>