<?php

namespace CMS\Modules\Article\Models;

use CMS\Functions\Load\Module as ModuleExtended;

class Display extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function load_article_select($array = []) {
		if(count($array) > 0){
			$al_fetch_articles = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_articles')
					->where('category = ?')
					->andWhere('publish = ?')
					->setParameter(0, $array['id'])
					->setParameter(1, '1')
					->orderBy('order1', 'ASC')
					->execute()
				);
				
			$al_fetch_articles = empty($al_fetch_articles) ? [] : $al_fetch_articles;
			return $al_fetch_articles;
		}
    }
	
	public function load_article_real_select($array = []) {
		if(count($array) > 0){
			$al_fetch_articles = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_articles')
					->where('id = ?')
					->andWhere('category = ?')
					->setParameter(0, $array['id'])
					->setParameter(1, '0')
					->execute()
				);
				
			$al_fetch_articles = empty($al_fetch_articles) ? [] : $al_fetch_articles;
			return $al_fetch_articles;
		}
    }
	
	public function load_articles_real($array = []) {
		$al_fetch_articles = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_articles')
				->where('publish = ?')
				->andWhere('category = ?')
				->orderBy('order1', 'ASC')
				->setParameter(0, '1')
				->setParameter(1, '0')
				->execute()
			);
			
		$al_fetch_articles = empty($al_fetch_articles) ? [] : $al_fetch_articles;
		return $al_fetch_articles;
    }
	
}

?>