<?php

namespace CMS\Modules\Gallery\Models;

use CMS\Functions\Load\Module as ModuleExtended;

class Display extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function load_gallery_select($array = []) {
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
}

?>