<?php

namespace CMS\Administrator\Modules\Contact;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Contact extends ModuleExtended {
	
    public function __construct($container) {
		parent::__construct($container);
    }

    public function contact_listed_admin_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$listed = $this->system_model->init("Contact", "Listed");
		
		$info = [
			'data'=> [
				'send_email_admin' => $post['send_email_admin'],
				'send_complete_mail' => $post['send_complete_email'],
				'users' => trim($post['email_user'])
			],
			'where'=> ['id' => '1']
		];
		
		$listed->contactAdminUpdate($info);
    }

    public function contact_listed() {
		$get = $this->v->_gA();
		$post = $this->v->_pA(['email_search_contact', 'gender_contact', 'email_contact', 'first_name_contact', 'last_name_contact', 'date_contact', 'time_contact', 'phone_contact', 'post_order_contact']);
		
		$listed = $this->system_model->init("Contact", "Listed");
		$contact_config = $listed->getContactConfig([]);
		
		$info = [
			'al_email_search' => $post['email_search_contact'],
			'al_gender' => $post['gender_contact'],
			'al_email' => $post['email_contact'],
			'al_first_name' => $post['first_name_contact'],
			'al_last_name' => $post['last_name_contact'],
			'al_date' => $post['date_contact'],
			'al_time' => $post['time_contact'],
			'al_phone' => $post['phone_contact'],
			'al_post_order' => $post['post_order_contact']
		];
		
		$contacts = $listed->contactListed($info);

        $this->system_view->init('Contact', 'ContactList');
        $this->system_view->assign('al_fetch_contacts', $contacts['rows']);
        $this->system_view->assign('al_fetch_contact_config', $contact_config);
        $this->system_view->assign('al_init_contact_rows', $contacts['total']);
        return $this->system_view->render();
    }
	
	public function update_show_contact() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
			
		$form = $this->system_form->init('contact', ['contact' => ['first_name','last_name','email','phone','postal_code','city','states','country','daybirth','monthbirth','yearbirth','gender','content']], 'send', $post);
		
		$info = [
			'data'=> $form['contact'],
			'where'=> ['id' => $get['id']]
		];
		
		$edit = $this->system_model->init("Contact", "Edit");
		$edit->contactUpdate($info);
    }


    public function contact_show_contact() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$listed = $this->system_model->init("Contact", "Listed");
		$contact = $listed->getContact(['id' => $get['id_contact']]);
		
		$form = $this->system_form->init('contact', ['contact' => ['date','time','first_name','last_name','email','phone','postal_code','city','states','country','daybirth','monthbirth','yearbirth','gender','content','id','id_module']], 'form', ['contact' => $contact]);

        $this->system_view->init('Contact', 'ShowContact');
        $this->system_view->assign('al_fetch_contact', $contact);
		$this->system_view->assign('form', $form);
		$this->system_view->assign('id', $contact->id);
        return $this->system_view->render();
    }

    public function contact_delete_contact() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$listed = $this->system_model->init("Contact", "Listed");
		$listed->deleteContact(['id' => $get['id_contact']]);
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
        
		$listed = $this->system_model->init("Contact", "Listed");
		$listed->deleteContact(['id_module' => $get['id']]);
		
		$listed = $this->system_model->init("Module", "Listed");
		$listed->deleteModule(['id' => $get['id']]);
    }
	
	/************************END BASIC FUNCTIONS***********************/
}

?>