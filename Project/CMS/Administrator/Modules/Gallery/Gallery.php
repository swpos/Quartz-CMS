<?php

namespace CMS\Administrator\Modules\Gallery;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Gallery extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function gallery_delete_picture() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
        unlink('../Media/gallery/' . $get['reference']);
    }

    public function gallery_listed() {
		$get = $this->v->_gA();
		$post = $this->v->_pA(['title_gallery', 'title_search_gallery', 'date_gallery', 'time_gallery', 'post_order_gallery']);
		
		$info = [
			'al_title' => $post['title_gallery'],
			'al_title_search' => $post['title_search_gallery'],
			'al_date' => $post['date_gallery'],
			'al_time' => $post['time_gallery'],
			'al_post_order' => $post['post_order_gallery']
		];
		
		$listed = $this->system_model->init("Gallery", "Listed");
		$galleries = $listed->galleryListed($info);

        $this->system_view->init('Gallery', 'GalleryList');
        $this->system_view->assign('al_fetch_galleries', $galleries['rows']);
        $this->system_view->assign('al_init_gallery_rows', $galleries['total']);
        return $this->system_view->render();
    }

    public function gallery_show_gallery() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$edit = $this->system_model->init("Module", "Edit");
		$gallery = $edit->getModuleById(['id' => $get['id_gallery']]);
        
        $images = [];
        $dir = '../Media/gallery';
        $folders = scandir($dir);
        foreach ($folders as $key => $value) {
            $id = explode('_', $value);
            if ($id[0] == $gallery->id) {
                $images[] = "<img src=\"../Media/gallery/" . $value . "\" width=\"100%\" height=\"auto\" />";
            }
        }

        $this->system_view->init('Gallery', 'ShowGallery');
        $this->system_view->assign('images', $images);
        $this->system_view->assign('al_fetch_gallery', $gallery);
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
		
		$formats = array("jpg", "png", "gif", "zip", "bmp");
		$path = "../Media/gallery/";
		$count = 0;

		if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
			foreach ($_FILES['files']['name'] as $f => $name) {
				if ($_FILES['files']['error'][$f] == 4) {
					continue;
				}
				if ($_FILES['files']['error'][$f] == 0) {
					if (!in_array(pathinfo(strtolower($name), PATHINFO_EXTENSION), $formats)) {
						continue;
					} else {
						if (move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path . $module_id . "_" . $name)) $count++;
					}
				}
			}
		}
    }

    public function _edit_module() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$name = $this->class_name;
		
		$edit = $this->system_model->init("Module", "Edit");
		$module = $edit->getModuleById(['id' => $get['id']]);
		
		$form = $this->system_form->init($name, ['modules' => $this->edit_module_fields], 'form', ['modules' => $module]);
				
		$dir = '../Media/gallery';
        $folders = scandir($dir);
        $images = [];
        foreach ($folders as $key => $value) {
            $id = explode('_', $value);

            if ($id[0] == $get['id']) {
                $images[] = "<img src=\"../Media/gallery/" . $value . "\" width=\"100%\" height=\"auto\" /><a href=\"index.php?page=Gallery&action=gallery_delete_picture&reference=" . urlencode($value) . "\" style=\"display:block;\">Delete</a>";
            }
        }
		
        $this->system_view->init(ucfirst($name), ucfirst($name));
		$this->system_view->assign('form', $form);
		$this->system_view->assign('al_images', $images);
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
				
		$formats = array("jpg", "jpeg", "png", "gif", "bmp");
		$path = "../Media/gallery/";
		$count = 0;

		if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
			foreach ($_FILES['files']['name'] as $f => $name) {
				if ($_FILES['files']['error'][$f] == 4) {
					continue;
				}
				if ($_FILES['files']['error'][$f] == 0) {
					if (!in_array(pathinfo(strtolower($name), PATHINFO_EXTENSION), $formats)) {
						continue;
					} else {
						if (move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path . $get['id'] . "_" . $name)) $count++;
					}
				}
			}
		}
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