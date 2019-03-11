<?php

namespace CMS\Administrator\Modules\Module\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Add extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function getModuleByCategory($array = []) {
		if(count($array) > 0){
			$al_fetch_modules_fetch = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_modules')
					->where('category = ?')
					->setParameter(0, $array['category'])
					->execute()
				);
				
			$al_fetch_modules_fetch = empty($al_fetch_modules_fetch) ? [] : $al_fetch_modules_fetch;
			return $al_fetch_modules_fetch;
		}
    }
	
	public function getModuleByCategoryTotal($array = []) {
		if(count($array) > 0){
			$al_fetch_modules = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('m.id')
					->from(HASH.'_modules', 'm')
					->where('category = ?')
					->setParameter(0, $array['category'])
					->execute()
				);
			
			$al_fetch_modules = count((array) $al_fetch_modules);
			$al_fetch_modules = empty($al_fetch_modules) ? 0 : $al_fetch_modules;
			return $al_fetch_modules;
		}
    }

    public function getPublishedPlugins($array = []) {
		$al_fetch_plugin = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_plugins')
				->where('publish = ?')
				->setParameter(0, '1')
				->execute()
			);
			
		$al_fetch_plugin = empty($al_fetch_plugin) ? [] : $al_fetch_plugin;
		return $al_fetch_plugin;
    }
	
	
	public function addModuleVerify($array = []) {
		if(count($array) > 0){
			return $this->system_shortcut->insert_module($array['title'], $array);			
		}
    }
	
	public function addCategory($array = []) {
		if(count($array) > 0){
			$this->data->insertIntoDatabase($array, HASH."_category");
		}
    }
	
	public function addSection($array = []) {
		if(count($array) > 0){
			$this->data->insertIntoDatabase($array, HASH."_section_name");
		}
    }	
}

?>