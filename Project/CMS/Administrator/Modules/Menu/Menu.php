<?php

namespace CMS\Administrator\Modules\Menu;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Menu extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function menu_listed() {
		$listed = $this->system_model->init("Menu", "Listed");
		$modules = $listed->getMenuModules([]);
		
        $this->system_view->init('Menu', 'MenuList');
        $this->system_view->assign('al_fetch_modules', $modules);
        return $this->system_view->render();
    }

    public function menu_add_link() {
		$edit = $this->system_model->init("Menu", "Edit");
		$section_name = $edit->getSections([]);
       
        $this->system_view->init('Menu', 'AddLink');
        $this->system_view->assign('al_fetch_section_name', $section_name);
        return $this->system_view->render();
    }

    public function menu_add_link_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$explode = explode('-', $post['section']);
        $id = $explode[0];
        $section = $explode[1];
		
        $add = $this->system_model->init("Menu", "Add");
		
		foreach ($post['link'] as $value) {
			if ($value && ($this->v->substr_count_array($value, $post['link']) == 1)) {
				$shortcut = $this->system_validation->format_link($value);
				
				$rows = $add->countMenuLink(['shortcut' => $shortcut]);
				
				if ($rows > 1) {
					$shortcut = substr(md5($value . rand(0, 10000000000)), 0, 6);
				}
				
				$info = [
					':id_index' => $id,
					':name' => $value,
					':shortcut' => $shortcut
				];
				
				$add->addLink($info);
			}
		}
    }

    public function menu_listed_menu_link() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();

		$listed = $this->system_model->init("Menu", "Listed");
        $sectionName = $listed->getSectionByModuleId(['id' => $get['id']]);
        $idSectionName = $sectionName->id;
		
		$edit = $this->system_model->init("Menu", "Edit");
        $menuLinks = $edit->getMenuLinksByIndex(['id' => $idSectionName]);
		$sections = $edit->getSections([]);

        $this->system_view->init('Menu', 'MenuLink');
        $this->system_view->assign('id', $get['id_link']);
        $this->system_view->assign('sectionName', $sectionName);
        $this->system_view->assign('sections', $sections);
        $this->system_view->assign('menuLinks', $menuLinks);
        return $this->system_view->render();
    }

    public function menu_listed_menu_link_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$shortcuts = $post['shortcut'];
		$register = $post['register'];
		$id_menu = $post['id_menu'];
		$al_order = $post['order'];
		$old_alias = $post['old_alias'];
		$alias = $post['alias'];
		
		$edit = $this->system_model->init("Menu", "Edit");
		$add = $this->system_model->init("Menu", "Add");
		$module_listed = $this->system_model->init("Module", "Listed");
		$module_edit = $this->system_model->init("Module", "Edit");
	   
	    foreach ($al_order as $key => $value) {
			$info =  [
				'data' => ['order1' => $value],
				'where' => ['id' => $key]
			];
			$edit->updateMenuLinkStandard($info);
        }
		
        foreach ($shortcuts as $key => $value) {
            if ($value) {
				$id = $key;
				$new_alias = (!empty($alias[$id])) ? $alias[$id] : $value;
					
				if(strpos($new_alias, 'http:') === false && strpos($new_alias, 'https:') === false){
					$format = $this->system_validation->format_link($new_alias);
					$rows = $add->countMenuLink(['shortcut' => $format]);
					if ($rows > 1) {
						$shortcut_link = $format.'_'.substr(md5($format . rand(0, 10000000000)), 0, 3);
					} else {
						$shortcut_link = $format;
					}
				} else {
					$shortcut_link = $new_alias;
				}
				
				$info2 = [
					'data' => [ 
						'name' => $value, 
						'shortcut' => $shortcut_link,
						'sub_menu' => $id_menu[$id],
						'register' => $register[$id]
					],
					'where' => ['id' => $id]
				];
				
				$edit->updateMenuLinkStandard($info2);
				$modules = $module_listed->getModules([]);
				
				foreach ($this->v->d_a($modules) as $item) {
                    $old_shortcut = explode(':', $item->shortcut);
                    $new_link = $shortcut_link;
                    if (in_array($old_alias[$id], $old_shortcut) && strtolower($new_link) != "all" && strtolower($new_link) != "index") {
                        $new_shortcut = str_replace($old_alias[$id], $new_link, $item->shortcut);
						
						$info4 = [
							'data' => ['shortcut' => $new_shortcut],
							'where' => ['id' => $item->id]
						];
						
						$module_edit->updateModuleStandard($info4);
                    }
                }
            }
        }
    }

    public function menu_edit_section_update() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
        
		$edit = $this->system_model->init("Menu", "Edit");
		
		$info = [
			'data' => ['id_index' => '0'],
			'where' => ['id_index' => $get['id_section']]
		];
		$edit->updateMenuLinkStandard($info);

		foreach ($post['shortcut'] as $key => $value) {
			$info2 = [
				'data' => ['id_index' => $get['id_section']],
				'where' => ['id' => $value]
			];
			$edit->updateMenuLinkStandard($info2);
		}
		
		$info3 = [
			'data' => ['section' => $post['title']],
			'where' => ['id' => $get['id_section']]
		];

		$edit->updateSectionStandard($info3);
    }

    public function menu_edit_section() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$edit = $this->system_model->init("Menu", "Edit");
		$listed = $this->system_model->init("Menu", "Listed");
		
		$sectionById = $edit->getSectionById(['id' => $get['id_section']]);
		$sectionByModule = $listed->getSectionByModuleId(['id' => $get['id_module']]);
		$idSection = $sectionByModule->id;
		$menuLinks = $edit->getSectionMenuLinks(['id' => $idSection]);
        
        $this->system_view->init('Menu', 'SectionLink');
        $this->system_view->assign('al_fetch_section_name1', $sectionById);
        $this->system_view->assign('al_fetch_section_name', $sectionByModule);
        $this->system_view->assign('al_fetch_link_menu', $menuLinks);
        return $this->system_view->render();
    }

    public function menu_delete_link() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
		$info = [
			'al_id_index' => $get['id_index'],
			'al_id_link' => $get['id_link'],
		];
		$edit = $this->system_model->init("Menu", "Edit");
		$module_edit = $this->system_model->init("Module", "Edit");
		
		$menuLinks = $edit->getMenuLinksByIdIndex($info);
        $itemName = $menuLinks->shortcut;
		
		$edit->deleteLinkMenu(['id' => $get['id_link']]);
		$module = $edit->getModulesWithShortcut(['shortcut' => $itemName]);
		
        foreach ($this->v->d_a($module) as $item) {
            $shortcut_all = explode(':', $item->shortcut);
            $full_shortcut = [];
            foreach ($shortcut_all as $key => $value) {
                if ($value != $itemName) {
                    $full_shortcut[] = $value;
                }
            }
            $full_shortcut = implode(':', $full_shortcut);
			
			$info = [
				'data' => ['shortcut' => $full_shortcut],
				'where' => ['id' => $item->id]
			];

			$module_edit->updateModuleStandard($info);
        }
    }

    public function menu_unpublish_link() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		
        $state = ($get['state'] == 1) ? 0 : 1;
        
		$edit = $this->system_model->init("Menu", "Edit");
		
		$info = [
			'data' => ['published' => $state],
			'where' => ['id' => $get['id_link']]
		];
		
		$edit->updateMenuLinkStandard($info);
    }
	
	/************************BASIC FUNCTIONS***********************/
	
	public function _add_module() {
		$name = $this->class_name;
        $this->system_view->init(ucfirst($name), 'AddModule');
        $form = $this->system_form->init($name, ['modules' => $this->add_module_fields], 'form', []);
        
		$section = $this->system_form->init($name, ['sectionname' => ['section']], 'form', []);
		
		$this->system_view->assign('form', $form);
	    $this->system_view->assign('section', $section);
        return $this->system_view->render();
    }

    public function _add_module_update() {		
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$name = $this->class_name;
		
		$module = $this->system_form->init($name, ['modules' => $this->add_module_update_fields], 'send', $post);
		$section_name = $this->system_form->init($name, ['sectionname' => ['section']], 'send', $post);
		
		$add = $this->system_model->init("Module", "Add");
		$module_id = $add->addModuleVerify($module['modules']);
		
		$info = [
			':section' => $section_name['sectionname']['section'],
			':id_module' => $module_id
		];
		$add->addSection($info);
    }

    public function _edit_module() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$name = $this->class_name;
		
		$edit = $this->system_model->init("Module", "Edit");
		$module = $edit->getModuleById(['id' => $get['id']]);
		$form = $this->system_form->init($name, ['modules' => $this->edit_module_fields], 'form', ['modules' => $module]);

		$listed = $this->system_model->init("Menu", "Listed");
		$sectionName = $listed->getSectionByModuleId(['id' => $get['id']]);		
        $id_menu = $sectionName->id;
		
		$edit = $this->system_model->init("Menu", "Edit");
		$menuLinks = $edit->getMenuLinksByIndex(['id' => $id_menu]);

        $this->system_view->init(ucfirst($name), ucfirst($name));
		$this->system_view->assign('al_fetch_section_name', $sectionName);
        $this->system_view->assign('al_fetch_link_menu', $menuLinks);
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
		
		$edit = $this->system_model->init("Menu", "Edit");
		
		foreach ($post['order'] as $key => $value) {
			$info = [
				'data' => ['order1' => $value],
				'where' => ['id' => $key]
			];
			$edit->updateMenuLinkStandard($info);
		}
    }
	
	public function _delete_module() {
		$get = $this->v->_gA();
		$post = $this->v->_pA();
		$name = $this->class_name;
        
		$listed = $this->system_model->init("Menu", "Listed");
		$menu = $listed->getSectionByModuleId(['id' => $get['id']]);
		$id_menu = $menu->id;
		
		$edit = $this->system_model->init("Menu", "Edit");
		$edit->deleteLinkMenu(['id_index' => $id_menu]);
		
		$listed = $this->system_model->init("Module", "Listed");
		$listed->deleteSectionByModuleId(['id_module' => $get['id']]);
		$listed->deleteModule(['id' => $get['id']]);		
    }
	
	/************************END BASIC FUNCTIONS***********************/

}

?>