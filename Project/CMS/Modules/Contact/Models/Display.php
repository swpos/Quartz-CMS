<?php

namespace CMS\Modules\Contact\Models;

use CMS\Functions\Load\Module as ModuleExtended;

class Display extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function post_contact_select($array = []) {
		$al_fetch_contact_config = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from('cms_contact_config')
				->execute()
			);
			
		$al_fetch_contact_config = empty($al_fetch_contact_config) ? [] : $al_fetch_contact_config;
		return $al_fetch_contact_config;
    }
	
	public function post_contact_select2($array = []) {
		$al_fetch_contact = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_users')
				->where('id = ?')
				->setParameter(0, '1')
				->execute()
			);
			
		$al_fetch_contact = empty($al_fetch_contact) ? [] : $al_fetch_contact;
		return $al_fetch_contact;
    }
	
	public function post_contact_insert($array = []) {
		if(count($array) > 0){
			$this->data->insertIntoDatabase($array, "cms_contact");
		}
    }	
}

?>