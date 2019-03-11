<?php

namespace CMS\Modules\User;

use CMS\Functions\Load\Module as ModuleExtended;

class User extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function load_user($id, $category, $title, $params) {
		$post = $this->v->_pA();
		$get = $this->v->_gA();
		$display = $this->system_model->init("User", "Display");
		
		$module = $display->load_module_select(['id' => $id]);
		$users = $display->load_users_select();

		$this->system_view->init('User', 'UserList');
		$this->system_view->assign('al_fetch_users', $users);
		$this->system_view->assign('al_fetch_modules', $module);
		$this->system_view->assign('params', $params);
		$this->system_view->assign('title_module', $title);
		$this->system_view->assign('shortcut', $get['page']);
		
		return $this->system_view->render();
    }
}

?>