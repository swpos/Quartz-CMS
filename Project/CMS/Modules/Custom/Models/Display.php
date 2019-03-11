<?php

namespace CMS\Modules\Custom\Models;

use CMS\Functions\Load\Module as ModuleExtended;

class Display extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function load_custom_select($array = []) {
		if(count($array) > 0){
			$al_fetch_modules = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_modules')
					->where('id = ?')
					->andWhere('published = ?')
					->setParameter(0, $array['id'])
					->setParameter(1, '1')
					->execute()
				);
				
			$al_fetch_modules = empty($al_fetch_modules) ? [] : $al_fetch_modules;
			return $al_fetch_modules;
		}
    }	
}

?>