<?php

namespace CMS\Administrator\Modules\Article\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Edit extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function getArticle($array = []){
		if(count($array) > 0){
			$al_fetch_articles = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_articles')
					->where('id = ?')
					->setParameter(0, $array['id'])
					->execute()
				);
				
			$al_fetch_articles = empty($al_fetch_articles) ? [] : $al_fetch_articles;
			return $al_fetch_articles;
		}
	}	
}

?>