<?php

namespace CMS\Administrator\Modules\Module\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Edit extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
    public function getModuleById($array = []) {
		if(count($array) > 0){
			$al_fetch_modules = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_modules')
					->where('id = ?')
					->setParameter(0, $array['id'])
					->execute()
				);
				
			$al_fetch_modules = empty($al_fetch_modules) ? [] : $al_fetch_modules;
			return $al_fetch_modules;
		}
    }
	
	public function updateModuleStandard($array = []) {
		if(count($array) > 0){
			$this->data->updateDatabase($array['data'], $array['where'], HASH.'_modules');
		}
	}
	
	public function moduleUpdateVerify($array = []) {
		if(count($array) > 0){
			$this->system_shortcut->edit_module($array);
		}
	}
}

?>