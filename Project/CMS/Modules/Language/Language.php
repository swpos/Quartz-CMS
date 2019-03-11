<?php

namespace CMS\Modules\Language;

use CMS\Functions\Load\Module as ModuleExtended;

class Language extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function changelang() {
		$post = $this->v->_pA();
		$get = $this->v->_gA();
		
        if ($get['id'] == "en") {
            $_SESSION['lang'] = "en";
        } 
		if ($get['id'] == "fr") {
            $_SESSION['lang'] = "fr";
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function load_language($id, $category, $title, $params) {
		$display = $this->system_model->init("Language", "Display");
		$modules = $display->load_language_select(['id' => $id]);

        $this->system_view->init('Language', 'Language');
        $this->system_view->assign('al_fetch_modules', $modules);
        $this->system_view->assign('params', $params);
        $this->system_view->assign('title_module', $title);
        return $this->system_view->render();
    }
}

?>