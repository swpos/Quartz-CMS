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