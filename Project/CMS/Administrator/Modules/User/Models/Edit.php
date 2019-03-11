<?php

namespace CMS\Administrator\Modules\User\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Edit extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function userUpdate($array = []) {
		if(count($array) > 0){
			$this->data->updateDatabase($array['data'], $array['where'],  HASH.'_users');
		}
    }
	
	public function addUser($array = []) {
		if(count($array) > 0){
			$this->data->insertIntoDatabase($array, HASH."_users");
		}
    }
	
	public function getUserById($array = []) {
		if(count($array) > 0){
			$al_fetch_users = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_users')
					->where('id = ?')
					->setParameter(0, $array['id'])
					->execute()
				);
				
			$al_fetch_users = empty($al_fetch_users) ? [] : $al_fetch_users;
			return $al_fetch_users;
		}
	}
	
	public function deleteUser($array = []) {
		if(count($array) > 0){
			$this->data->deleteEntry($array, HASH.'_users');
		}
    }
}

?>