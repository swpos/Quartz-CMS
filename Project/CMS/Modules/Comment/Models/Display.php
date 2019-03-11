<?php

namespace CMS\Modules\Comment\Models;

use CMS\Functions\Load\Module as ModuleExtended;

class Display extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function load_comment_select($array = []) {
		if(count($array) > 0){
			$al_fetch_comments = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('c.id, c.title, c.content, c.date, c.time, c.username, c.email')
					->from(HASH.'_modules', 'm')
					->innerJoin('m', 'cms_comments', 'c', 'c.id_module = m.id')
					->where('m.shortcut LIKE ?')
					->andWhere('c.shortcut = ?')
					->setParameter(0, '%'.$array['page'].'%')
					->setParameter(1, $array['page'])
					->execute()
				);
				
			$al_fetch_comments = empty($al_fetch_comments) ? [] : $al_fetch_comments;
			return $al_fetch_comments;
		}
    }
	
	public function post_comment_insert($array = []) {
		if(count($array) > 0){
			$this->data->insertIntoDatabase($array, "cms_comments");
		}
    }
	
	public function delete_comment($array = []) {
		if(count($array) > 0){
			$this->data->deleteEntry($array, 'cms_comments');
		}
    }	
}

?>