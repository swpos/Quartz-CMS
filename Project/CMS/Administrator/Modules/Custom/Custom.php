<?php

namespace CMS\Administrator\Modules\Custom;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Custom extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	/************************BASIC FUNCTIONS***********************/
	
	public function _add_module() {
		$name = $this->class_name;
		
        $this->system_view->init(ucfirst($name), 'AddModule');
        $form = $this->system_form->init($name, ['modules' => array_merge($this->add_module_fields, ['content'])], 'form', []);
	    $this->system_view->assign('form', $form);
        return $this->system_view->render();
    }

    public function _add_module_update() {		
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$name = $this->class_name;
		
		$module = $this->system_form->init($name, ['modules' => array_merge($this->add_module_update_fields, ['content'])], 'send', $post);
		
		$add = $this->system_model->init("Module", "Add");
		$module_id = $add->addModuleVerify($module['modules']);
    }

    public function _edit_module() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$name = $this->class_name;
		
		$edit = $this->system_model->init("Module", "Edit");
		$module = $edit->getModuleById(['id' => $get['id']]);
		
		$form = $this->system_form->init($name, ['modules' => array_merge($this->edit_module_fields, ['content'])], 'form', ['modules' => $module]);

        $this->system_view->init(ucfirst($name), ucfirst($name));
		$this->system_view->assign('form', $form);
		$this->system_view->assign('id', $module->id);
        return $this->system_view->render();
    }

    public function _edit_module_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$name = $this->class_name;
		
		$module = $this->system_form->init($name, ['modules' => array_merge($this->edit_module_update_fields, ['content'])], 'send', $post);
				
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