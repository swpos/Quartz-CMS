<?php

namespace CMS\Modules\Counter\Models;

use CMS\Functions\Load\Module as ModuleExtended;

class Display extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function new_visit_select($array = []) {
		if(count($array) > 0){
			$al_fetch_module = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_modules')
					->where('id = ?')
					->setParameter(0, $array['id'])
					->execute()
				);
				
			$al_fetch_module = empty($al_fetch_module) ? [] : $al_fetch_module;
			return $al_fetch_module;
		}
    }	
}

?>