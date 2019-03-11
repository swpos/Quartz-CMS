<?php

namespace CMS\Administrator\Modules\Config\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Listed extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function configurationListed($array = []) {
		$al_fetch_config = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_config')
				->where('id = ?')
				->setParameter(0, '1')
				->execute()
			);
		
		$al_fetch_config = empty($al_fetch_config) ? [] : $al_fetch_config;
		return $al_fetch_config;
    }
	
	public function configurationUpdate($array = []) {
		if(count($array) > 0){
			$this->data->updateDatabase($array['data'], $array['where'],  HASH.'_config');
		}
    }
}

?>