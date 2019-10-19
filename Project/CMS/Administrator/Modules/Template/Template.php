<?php

namespace CMS\Administrator\Modules\Template;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Template extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function template_listed() {
        $dir = '../Templates';
        $folders = scandir($dir);
		
		$listed = $this->system_model->init("Template", "Listed");
		
	    foreach ($folders as $key => $value) {
			if (($value != '..') && ($value != '.')) {
				$rows = $listed->getTemplateByTitle(['value' => $value]);
                
				if (!$rows) {
					$listed->insertTemplate([':title' => $value]);
                }
            }
        }

        $this->system_view->init('Template', 'TemplateList');
        $this->system_view->assign('al_get_folders', $folders);
        return $this->system_view->render();
    }
	
	public function source($path) {
		$content = str_replace('<textarea', '<3049853--textarea', file_get_contents($path));
		return str_replace('</textarea', '</3049853--textarea', $content);
	}
	
	public function template_edit_post() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$namefile = $post['namefile'];
		$location = $post['location'];
		
		if(!empty($namefile)){
			$handle = fopen($location.'/'.$namefile, "w");
			fwrite($handle, '');
			fclose($handle);
		} else {
			$folder = $get['folder'];
			$file = $get['file'];
			$folder = $post['folder'];
			$rename = $post['rename'];
			$delete = $post['delete'];
			$path = $post['path'];
			if(!empty($delete)){
				if(!is_dir($path)){
					unlink($path);
				}
			} else {
				$path_temp = explode('/', $path);
				$path_temp = end($path_temp);
				$rename = str_replace('/', '', $rename);
				if($path_temp != $rename){
					rename($path, $folder.'/'.$rename);
					$file = $rename;
				}
				if(!is_dir($folder.'/'.$file)){
					if(strpos(mime_content_type($folder.'/'.$file), 'image') === false &&
					strpos(mime_content_type($folder.'/'.$file), 'video') === false &&
					strpos(mime_content_type($folder.'/'.$file), 'application') === false){	
						$handle = fopen($folder.'/'.$file, "w");
						$content = str_replace('<3049853--textarea', '<textarea', $post['content']);
						$content = str_replace('</3049853--textarea', '</textarea', $content);
						fwrite($handle, $content);
						fclose($handle);
					}
				}
			}
		}
	}
	public function template_edit() {
        $get = $this->v->_gA();
		$post = $this->v->_pA();
		$folder = $get['folder'];
		$file = $get['file'];
		$alias = $get['alias'];
        if($folder == '../Templates/'.$alias){
			if(empty($file)){
				$file = 'index.php';
			}
		}
		if(!is_dir($folder)){
			$folder = '../Templates/'.$alias;
			$file = 'index.php';
		}
		$source = '';
		$fichier_mime = 0;
		if(!empty($file) && !is_dir($folder.'/'.$file)){
			if(strpos(mime_content_type($folder.'/'.$file), 'image') === false &&
			strpos(mime_content_type($folder.'/'.$file), 'video') === false &&
			strpos(mime_content_type($folder.'/'.$file), 'application') === false){ 
				$source = $this->source($folder.'/'.$file);
			} else {
				$fichier_mime = 1;
			}
		}

        $this->system_view->init('Template', 'Template');
        $this->system_view->assign('folder', $folder);
        $this->system_view->assign('file', $file);
        $this->system_view->assign('alias', $alias);
        $this->system_view->assign('fichier_mime', $fichier_mime);
        $this->system_view->assign('source', $source);
        return $this->system_view->render();
    }

    public function template_listed_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$edit = $this->system_model->init("Template", "Edit");
				
		$info = [
			'data' => ['active' => '0'],
			'where' => ['admin' => '0']
		];
		
		$edit->updateTemplate($info);
		
		$info = [
			'data' => [
				'active' => '1',
				'time' => date('H:i:s'),
				'date' => date('Y-m-d')
			],
			'where' => ['id' => $post['active']]
		];
		
		$edit->updateTemplate($info);
        
        foreach ($post['description'] as $key => $value) {
			$info = [
				'data' => ['description' => $value],
				'where' => ['id' => $key]
			];
			
			$edit->updateTemplate($info);
        }
    }

}

?>