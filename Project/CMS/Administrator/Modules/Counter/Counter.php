<?php

namespace CMS\Administrator\Modules\Counter;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Counter extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function counter_listed() {
		$listed = $this->system_model->init("Counter", "Listed");
		$modules = $listed->counterListed([]);
		
        $time = date('Ymd');
        $filename_path = '../Modules/Counter/visit/counter.txt';
        $content1 = file_get_contents($filename_path);
        $filename_path2 = '../Modules/Counter/visit/counter2.txt';
        $file_open = fopen($filename_path2, "r");
        $contents2 = fread($file_open, filesize($filename_path2));
        fclose($file_open);
        $y = 0;
        $explode = explode(":", $contents2);
        $count = count($explode);
        for ($i = 0; $i < $count; $i++) {
            if ($explode[$i] == $time) {
                $y++;
            }
        }

        $this->system_view->init('Counter', 'CounterList');
        $this->system_view->assign('al_fetch_modules', $modules);
        $this->system_view->assign('al_y1', $y);
        $this->system_view->assign('al_file_content1', $content1);
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