<?php

namespace CMS\Administrator\Modules\Language;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Language extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function changelang() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();

        if ($get['lang'] == "en") {
            $_SESSION['lang'] = "en";
        } else {
            $_SESSION['lang'] = "fr";
        }
    }
	
	public function source($path) {
		$content = str_replace('<textarea', '<3049853--textarea', file_get_contents($path));
		return str_replace('</textarea', '</3049853--textarea', $content);
	}
	
	public function language_edit_post() {
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
	public function language_edit() {
        $get = $this->v->_gA();
		$post = $this->v->_pA();
		$folder = $get['folder'];
		$file = $get['file'];
        if($folder == '../Languages'){
			if(empty($file)){
				$file = 'index.html';
			}
		}
		if(!is_dir($folder)){
			$folder = '../Languages';
			$file = 'index.html';
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

        $this->system_view->init('Language', 'EditLanguages');
        $this->system_view->assign('folder', $folder);
        $this->system_view->assign('file', $file);
        $this->system_view->assign('fichier_mime', $fichier_mime);
        $this->system_view->assign('source', $source);
        return $this->system_view->render();
    }
	
	/************************BASIC FUNCTIONS***********************/
	
	public function _add_module() {
		$name = $this->class_name;
        $this->system_view->init(ucfirst($name), 'AddModule');
        $form = $this->system_form->init($name, ['modules' => $this->add_module_fields], 'form', []);
	    $this->system_view->assign('form', $form);
        return $this->system_view->render();
    }

    public function _add_module_update() {		
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$name = $this->class_name;
		
		$module = $this->system_form->init($name, ['modules' => $this->add_module_update_fields], 'send', $post);
		
		$add = $this->system_model->init("Module", "Add");
		$module_id = $add->addModuleVerify($module['modules']);
    }

    public function _edit_module() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$name = $this->class_name;
		
		$edit = $this->system_model->init("Module", "Edit");
		$module = $edit->getModuleById(['id' => $get['id']]);
		
		$form = $this->system_form->init($name, ['modules' => $this->edit_module_fields], 'form', ['modules' => $module]);

        $this->system_view->init(ucfirst($name), ucfirst($name));
		$this->system_view->assign('form', $form);
		$this->system_view->assign('id', $module->id);
        return $this->system_view->render();
    }

    public function _edit_module_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$name = $this->class_name;
		
		$module = $this->system_form->init($name, ['modules' => $this->edit_module_update_fields], 'send', $post);
		
		$info = [
			'category' => [],
			'module' => [
				'data' => $module['modules'],
				'where' => ['id' => $get['id']]
			]
		];
		
		$edit = $this->system_model->init("Module", "Edit");
		$edit->moduleUpdateVerify($info);
    }
	
	public function _delete_module() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$name = $this->class_name;
		
		$listed = $this->system_model->init("Module", "Listed");
		$listed->deleteModule(['id' => $get['id']]);
    }
	
	/************************END BASIC FUNCTIONS***********************/
}

?>