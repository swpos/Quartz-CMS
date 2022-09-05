<?php

namespace CMS\Administrator\Modules\User;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class User extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function user_listed() {	
		$get = $this->v->_gA();
		$post = $this->v->_pA(['search_user', 'username_user', 'first_name_search_user', 'first_name_user', 'last_name_search_user', 'last_name_user', 'email_search_user', 'email_user', 'post_order_user']);
		
		$info = [
			'al_search' => $post['search_user'],
			'al_username' => $post['username_user'],
			'al_first_name_search' => $post['first_name_search_user'],
			'al_first_name' => $post['first_name_user'],
			'al_last_name_search' => $post['last_name_search_user'],
			'al_last_name' => $post['last_name_user'],
			'al_email_search' => $post['email_search_user'],
			'al_email' => $post['email_user'],
			'al_post_order' => $post['post_order_user']
		];		
		
		$listed = $this->system_model->init("User", "Listed");
		$users = $listed->usersList($info);

        $this->system_view->init('User', 'UserList');
        $this->system_view->assign('al_fetch_users', $users['rows']);
        $this->system_view->assign('al_init_users_rows', $users['total']);
        return $this->system_view->render();
    }
	
	public function role_listed() {	
		$get = $this->v->_gA();
		$post = $this->v->_pA(['search_role', 'role_roles', 'post_order_role']);
		
		$info = [
			'al_search' => $post['search_role'],
			'role_roles' => $post['role_roles'],
			'al_post_order' => $post['post_order_role']
		];		
		
		$listed = $this->system_model->init("User", "Listed");
		$roles = $listed->rolesList($info);

        $this->system_view->init('User', 'RoleList');
        $this->system_view->assign('al_fetch_roles', $roles['rows']);
        $this->system_view->assign('al_init_roles_rows', $roles['total']);
        return $this->system_view->render();
    }

    public function user_edit_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$edit = $this->system_model->init("User", "Edit");

		if (!empty($post['user']['id'])) {
			if (!empty($post['user']['password'])) {
				$form = $this->system_form->init('user', ['users' => ['username','password','email','role','picture','gender','city','first_name','last_name','age','about','country']], 'send', $post);
			} else {
				$form = $this->system_form->init('user', ['users' => ['username','email','role','picture','gender','city','first_name','last_name','age','about','country']], 'send', $post);
			}
			$info = [
				'data' => $form['users'], 
				'where' => ['id' => $post['user']['id']]
			];

			$edit->userUpdate($info);
		} else {
			$form = $this->system_form->init('user', ['users' => ['username','password','email','role','picture','gender','city','first_name','last_name','age','about','country']], 'send', $post);
			$edit->addUser($form['users']);
		}
    }
	
	public function role_edit_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$edit = $this->system_model->init("User", "Edit");

		if (!empty($post['user']['id'])) {
			$form = $this->system_form->init('user', ['roles' => ['role','notes']], 'send', $post);
			$info = [
				'data' => $form['roles'], 
				'where' => ['id' => $post['user']['id']]
			];

			$edit->roleUpdate($info);
		} else {
			$form = $this->system_form->init('user', ['roles' => ['role','notes']], 'send', $post);
			$edit->addRole($form['roles']);
		}
    }

    public function user_add_user() {
		$form = $this->system_form->init('user', ['users' => ['username','first_name','last_name','password','email','role','picture','gender','city','age','about','country']], 'form', []);
        $this->system_view->init('User', 'AddUser');
        $this->system_view->assign('form', $form);
        return $this->system_view->render();
    }
	
	public function role_add_role() {
		$form = $this->system_form->init('user', ['roles' => ['role','notes']], 'form', []);
        $this->system_view->init('User', 'AddRole');
        $this->system_view->assign('form', $form);
        return $this->system_view->render();
    }

    public function user_edit() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$edit = $this->system_model->init("User", "Edit");
		$users = $edit->getUserById(['id' => $get['id']]);
		$form = $this->system_form->init('user', ['users' => ['username','first_name','last_name','password','email','role','picture','gender','city','age','about','country','id']], 'form', ['users' => $users]);
		
		$this->system_view->init('User', 'ModifUser');
        $this->system_view->assign('al_fetch_users', $users);
        $this->system_view->assign('form', $form);
        return $this->system_view->render();
    }

	public function role_edit() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$edit = $this->system_model->init("User", "Edit");
		$roles = $edit->getRoleById(['id' => $get['id']]);
		$form = $this->system_form->init('user', ['roles' => ['role','notes','id']], 'form', ['roles' => $roles]);
		
		$this->system_view->init('User', 'ModifRole');
        $this->system_view->assign('al_fetch_roles', $roles);
        $this->system_view->assign('form', $form);
        return $this->system_view->render();
    }

    public function user_delete() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();

		$edit = $this->system_model->init("User", "Edit");

        foreach ($post['delete'] as $key => $value) {
            if ($value != '1') {
				$edit->deleteUser(['id' => $value]);                
            }
        }
    }
	
	public function role_delete() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();

		$edit = $this->system_model->init("User", "Edit");

        foreach ($post['delete'] as $key => $value) {
            if ($value != '1') {
				$edit->deleteRole(['id' => $value]);                
            }
        }
    }
	
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

}

?>