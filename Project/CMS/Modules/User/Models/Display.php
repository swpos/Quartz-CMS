<?php

namespace CMS\Modules\User\Models;

use CMS\Functions\Load\Module as ModuleExtended;

class Display extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function load_module_select($array = []) {
		if(count($array) > 0){
			$al_fetch_modules = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_modules')
					->andWhere('id = ?')
					->setParameter(0, $array['id'])
					->execute()
				);
				
			$al_fetch_modules = empty($al_fetch_modules) ? [] : $al_fetch_modules;
			return $al_fetch_modules;
		}
    }	
	
	public function load_users_select() {
		$al_fetch_modules = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_users')
				->andWhere('blocked = ?')
				->setParameter(0, '0')
				->execute()
			);
			
		$al_fetch_modules = empty($al_fetch_modules) ? [] : $al_fetch_modules;
		return $al_fetch_modules;
    }	
	
    public function load_user_select($array = []) {
		if(count($array) > 0){
			$al_fetch_modules = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_users')
					->where('id = ?')
					->andWhere('blocked = ?')
					->setParameter(0, $array['id'])
					->setParameter(1, '0')
					->execute()
				);
				
			$al_fetch_modules = empty($al_fetch_modules) ? [] : $al_fetch_modules;
			return $al_fetch_modules;
		}
    }	
}

?>