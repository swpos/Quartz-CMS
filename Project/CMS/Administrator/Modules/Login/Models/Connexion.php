<?php

namespace CMS\Administrator\Modules\Login\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Connexion extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function countUsers($array = []) {
		if(count($array) > 0){
			$al_fetch_users = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_users')
					->where('password = ?')
					->andWhere('username = ?')
					->setParameter(0, $array['al_passe_membre'])
					->setParameter(1, $array['al_pseudo_membre'])
					->execute()
				);
			
			$al_verif_nb = count((array) $al_fetch_users);
			$al_verif_nb = empty($al_verif_nb) ? "" : $al_verif_nb;
			return $al_verif_nb;
		}
	}
	
	public function getUser($array = []) {
		if(count($array) > 0){
			$al_row = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_users')
					->where('password = ?')
					->andWhere('username = ?')
					->setParameter(0, $array['al_passe_membre'])
					->setParameter(1, $array['al_pseudo_membre'])
					->execute()
				);
				
			$al_row = empty($al_row) ? [] : $al_row;
			return $al_row;
		}
	}
}

?>