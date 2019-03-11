<?php

namespace CMS\Administrator\Modules\Template\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Listed extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function getTemplateByTitle($array = []) {
		if(count($array) > 0){
			$al_fetch_templates = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_template')
					->where('title = ?')
					->setParameter(0, $array['value'])
					->execute()
				);
			
			$al_num_template = count((array) $al_fetch_templates);
			$al_num_template = empty($al_num_template) ? "" : $al_num_template;
			return $al_num_template;
		}
    }
	
	public function insertTemplate($array = []) {
		if(count($array) > 0){
			$this->data->insertIntoDatabase($array, HASH."_template");
		}
    }
	
	 
		
}

?>