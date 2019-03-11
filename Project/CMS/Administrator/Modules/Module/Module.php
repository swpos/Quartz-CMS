<?php

namespace CMS\Administrator\Modules\Module;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Module extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function module_add() {
		$add = $this->system_model->init("Module", "Add");
		$plugins = $add->getPublishedPlugins([]);

        $this->system_view->init('Module', 'AddModule');
        $this->system_view->assign('al_fetch_plugin', $plugins);
        return $this->system_view->render();
	}

    public function module() {
		$get = $this->v->_gA();
		$post = $this->v->_pA(['search_module', 'type_module', 'category_module', 'order_module', 'time_module', 'date_module', 'position_module', 'position_type_module', 'published_module', 'post_order_module']);
		
		$info = [
			'al_search' => $post['search_module'],
			'al_type' => $post['type_module'],
			'al_category' => $post['category_module'],
			'al_order' => $post['order_module'],
			'al_time' => $post['time_module'],
			'al_date' => $post['date_module'],
			'al_position' => $post['position_module'],
			'al_position_type' => $post['position_type_module'],
			'al_published' => $post['published_module'],
			'al_post_order' => $post['post_order_module']
		];
		
		$listed = $this->system_model->init("Module", "Listed");
		$modules = $listed->getModulesList($info);
		$plugins = $listed->getPlugins([]);

        $this->system_view->init('Module', 'ModuleList');
        $this->system_view->assign('plugins', $plugins);
        $this->system_view->assign('al_fetch_modules', $modules['rows']);
        $this->system_view->assign('al_init_modules_rows', $modules['total']);
        return $this->system_view->render();
    }

    public function module_publish() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$enable = ($get['state'] == '1') ? 0 : 1;
		
		$edit = $this->system_model->init("Module", "Edit");
		$info = [
			'data' => ['published' => $enable],
			'where' => ['id' => $get['id']]
		];
		$edit->updateModuleStandard($info);
    }

    public function module_order() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
    	$edit = $this->system_model->init("Module", "Edit");

		foreach ($post['order'] as $key => $value) {
			$info = [
				'data' => ['order1' => $value], 
				'where' => ['id' => $key]
			];
			
			$edit->updateModuleStandard($info);
        }
    }
}

?>