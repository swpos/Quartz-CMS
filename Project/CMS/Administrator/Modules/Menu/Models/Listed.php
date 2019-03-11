<?php

namespace CMS\Administrator\Modules\Menu\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Listed extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function getMenuModules($array = []) {
		$al_fetch_modules = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_modules')
				->where('modules LIKE ?')
				->andWhere('title <> ?')
				->setParameter(0, '%type_menu%')
				->setParameter(1, 'hidden')
				->execute()
			);
		$al_fetch_modules = empty($al_fetch_modules) ? [] : $al_fetch_modules;
		return $al_fetch_modules;
    }
	
	public function getSectionByModuleId($array = []) {
		if(count($array) > 0){
			$al_fetch_modules = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_section_name')
					->where('id_module = ?')
					->setParameter(0, $array['id'])
					->execute()
				);
				
			$al_fetch_modules = empty($al_fetch_modules) ? [] : $al_fetch_modules;
			return $al_fetch_modules;
		}
	}
}

?>