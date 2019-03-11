<?php

namespace CMS\Administrator\Modules\Counter\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Listed extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function counterListed($array = []) {
		$al_fetch_modules = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_modules')
				->where('modules LIKE ?')
				->setParameter(0, '%type_counter%')
				->execute()
			);
		
		$al_fetch_modules = empty($al_fetch_modules) ? [] : $al_fetch_modules;
		return $al_fetch_modules;
	}
}

?>