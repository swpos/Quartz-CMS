<?php

namespace CMS\Modules\Menu;

use CMS\Functions\Load\Module as ModuleExtended;

class Menu extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function load_menu($id, $category, $title, $params) {
        $this->system_view->init('Menu', 'Menu');
        $this->system_view->assign('id', $id);
        $this->system_view->assign('params', $params);
        return $this->system_view->render();
    }

}

?>