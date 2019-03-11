<?php

namespace CMS\Modules\Gallery;

use CMS\Functions\Load\Module as ModuleExtended;

class Gallery extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function load_gallery($id, $category, $title, $params) {
		$display = $this->system_model->init("Gallery", "Display");
		$modules = $display->load_gallery_select(['id' => $id]);

        $this->system_view->init('Gallery', 'Gallery');
        $this->system_view->assign('modules', $modules);
        $this->system_view->assign('params', $params);
        $this->system_view->assign('id', $id);
        return $this->system_view->render();
    }

}

?>