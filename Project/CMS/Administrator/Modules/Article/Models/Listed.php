<?php

namespace CMS\Administrator\Modules\Article\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Listed extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function articleListed($array = []) {
		if(count($array) > 0){
			$buildQuery = "";
			if (!empty($array['al_search']) || !empty($array['al_published'])) {
				$order = "WHERE";
				$order1 = [];
	
				if (!empty($array['al_search'])) {
					$order1[].=" title LIKE '%" . $this->v->e($array['al_search']) . "%'";
				}
				if (!empty($array['al_published'])) {
					if ($array['al_published'] == 'yes') {
						$array['al_published'] = "1";
					} else {
						$array['al_published'] = "0";
					}
					$order1[].=" publish = '" . $array['al_published'] . "'";
				}
				$buildQuery.=$order . implode(" AND ", $order1);
			}
	
			if (!empty($array['al_category']) || !empty($array['al_order']) || !empty($array['al_time']) || !empty($array['al_date'])) {
				$order = " ORDER BY";
				$order2 = [];
				if (!empty($array['al_category'])) {
					$order2[].=" category " . $array['al_category'];
				}
				if (!empty($array['al_order'])) {
					$order2[].=" order1 " . $array['al_order'];
				}
				if (!empty($array['al_time'])) {
					$order2[].=" time " . $array['al_time'];
				}
				if (!empty($array['al_date'])) {
					$order2[].=" date " . $array['al_date'];
				}
				$buildQuery.=$order . implode(", ", $order2);
			}
			if (!empty($this->v->_p('post_order_article'))) {
				$_SESSION['order_article_query'] = $buildQuery;
			} else {
				if(!empty($this->v->_s('order_article_query'))){
					$buildQuery = $this->v->_s('order_article_query');
				}
			}
			$total = count((Array) $this->data->getData($this->db->query("SELECT * FROM " . HASH . "_articles " . $buildQuery)));
			$al_fetch_articles = $this->data->getData($this->db->query("SELECT * FROM " . HASH . "_articles " . $buildQuery . " " . $this->system_pagination->get_pagination($total)));
			$al_fetch_articles = empty($al_fetch_articles) ? [] : $al_fetch_articles;
			return ['rows' => $al_fetch_articles, 'total' => $total];
		}
    }
	
	public function articlesCount($array = []) {
		$al_fetch_articles = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_articles')
				->execute()
			);
		$al_init_articles_rows = count((array) $al_fetch_articles);
		$al_init_articles_rows = empty($al_init_articles_rows) ? "" : $al_init_articles_rows;
		return $al_init_articles_rows;
	}
	
	public function articleUpdate($array = []) {
		if(count($array) > 0){
			$this->data->updateDatabase($array['data'], $array['where'], HASH.'_articles');
		}
	}
	
	public function deleteArticle($array = []) {
		if(count($array) > 0){
			$this->data->deleteEntry($array, HASH.'_articles');
		}
	}	
}

?>