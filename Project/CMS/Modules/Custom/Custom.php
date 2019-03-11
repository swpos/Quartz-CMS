<?php

namespace CMS\Modules\Custom;

use CMS\Functions\Load\Module as ModuleExtended;

class Custom extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function load_custom($id, $category, $title, $params) {
		$display = $this->system_model->init("Custom", "Display");
		$modules = $display->load_custom_select(['id' => $id]);

        $this->system_view->init('Custom', 'Custom');
        $this->system_view->assign('al_fetch_modules', $modules);
        $this->system_view->assign('params', $params);
        $this->system_view->assign('title_module', $title);
        return $this->system_view->render();
    }
}

?>