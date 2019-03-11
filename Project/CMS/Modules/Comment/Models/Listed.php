<?php

namespace CMS\Administrator\Modules\Comment\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Listed extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function commentListed($array = []) {
		if(count($array) > 0){
			$buildQuery = "";
			if (!empty($array['al_title_search']) || !empty($array['al_username_search'])) {
				$order = "WHERE";
				$order1 = [];
	
				if (!empty($array['al_title_search'])) {
					$order1[].=" title LIKE '%" . $this->v->e($array['al_title_search']). "%'";
				}
				if (!empty($array['al_username_search'])) {
					$order1[].=" username LIKE '%" . $this->v->e($array['al_username_search']) . "%'";
				}
				$buildQuery.=$order . implode(" AND ", $order1);
			}
	
			if (!empty($array['al_title']) || !empty($array['al_username']) || !empty($array['al_date']) || !empty($array['al_time']) || !empty($array['al_email'])) {
				$order = " ORDER BY";
				$order2 = [];
				if (!empty($array['al_title'])) {
					$order2[].=" title " . $array['al_title'];
				}
				if (!empty($array['al_username'])) {
					$order2[].=" username " . $array['al_username'];
				}
				if (!empty($array['al_time'])) {
					$order2[].=" time " . $array['al_time'];
				}
				if (!empty($array['al_date'])) {
					$order2[].=" date " . $array['al_date'];
				}
				if (!empty($array['al_email'])) {
					$order2[].=" email " . $array['al_email'];
				}
				$buildQuery.=$order . implode(", ", $order2);
			}
			if (!empty($this->v->_p('post_order_comment'))) {
				$_SESSION['order_comment_query'] = $buildQuery;
			} else {
				if(!empty($this->v->_s('order_comment_query'))){
					$buildQuery = $this->v->_s('order_comment_query');
				}
			}
			$total = count($this->data->getData($this->db->query("SELECT * FROM cms_comments " . $buildQuery)));
			$al_fetch_comments = $this->data->getData($this->db->query("SELECT * FROM cms_comments " . $buildQuery . " " . $this->system_pagination->get_pagination($total)));
			$al_fetch_comments = empty($al_fetch_comments) ? [] : $al_fetch_comments;
			return ['rows' => $al_fetch_comments, 'total' => $total];
		}
    }
	
	public function countComments($array = []) {
		$al_fetch_comments = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from('cms_comments')
				->execute()
			);
			
        $al_init_comments_rows = count((array) $al_fetch_comments);
		$al_init_comments_rows = empty($al_init_comments_rows) ? "" : $al_init_comments_rows;
		return $al_init_comments_rows;
	}
	
	public function showComment($array = []) {
		if(count($array) > 0){
			$al_fetch_comments = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from('cms_comments')
					->where('id = ?')
					->setParameter(0, $array['id'])
					->execute()
				);
			
			$al_fetch_comments = empty($al_fetch_comments) ? [] : $al_fetch_comments;
			return $al_fetch_comments;
		}
	}
	
	public function deleteComment($array = []) {
		if(count($array) > 0){
			$this->data->deleteEntry($array, 'cms_comments');
		}
	}
}

?>