<?php

namespace CMS\Administrator\Modules\Menu\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Add extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function countMenuLink($array = []) {
		if(count($array) > 0){
			$query = $this->data->getData(
					$this->db->createQueryBuilder()
					->select('COUNT(id) AS number')
					->from(HASH.'_link_menu')
					->where('shortcut = ?')
					->setParameter(0, $array['shortcut'])
					->execute()
				);
				
			$number_of_rows = $query->number;
			$number_of_rows = empty($number_of_rows) ? "" : $number_of_rows;
			return $number_of_rows;
		}
    }	
	
	public function addLink($array = []) {
		if(count($array) > 0){
			$this->data->insertIntoDatabase($array, HASH."_link_menu");
		}
    }	
}

?>