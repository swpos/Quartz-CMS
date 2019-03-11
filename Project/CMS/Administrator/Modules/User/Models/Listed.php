<?php

namespace CMS\Administrator\Modules\User\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Listed extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function usersList($array = []) {
		if(count($array) > 0){
			$buildQuery = "";
			if (!empty($array['al_search']) || !empty($array['al_first_name_search']) || !empty($array['al_last_name_search']) || !empty($array['al_email_search'])) {
				$order = "WHERE";
				$order1 = [];
				if (!empty($array['al_search'])) {
					$order1[].=" username LIKE '%" . $this->v->e($array['al_search']) . "%'";
				}
				if (!empty($array['al_first_name_search'])) {
					$order1[].=" first_name LIKE '%" . $array['al_first_name_search'] . "%'";
				}
				if (!empty($array['al_last_name_search'])) {
					$order1[].=" last_name LIKE '%" . $array['al_last_name_search'] . "%'";
				}
				if (!empty($array['al_email_search'])) {
					$order1[].=" email LIKE '%" . $array['al_email_search'] . "%'";
				}
				$buildQuery.=$order . implode(" AND ", $order1);
			}
	
			if (!empty($array['al_first_name']) || !empty($array['al_last_name']) || !empty($array['al_email']) || !empty($array['al_username'])) {
				$order = " ORDER BY";
				$order2 = [];
				if (!empty($array['al_username'])) {
					$order2[].=" username " . $array['al_username'];
				}
				if (!empty($array['al_first_name'])) {
					$order2[].=" first_name " . $array['al_first_name'];
				}
				if (!empty($array['al_last_name'])) {
					$order2[].=" last_name " . $array['al_last_name'];
				}
				if (!empty($array['al_email'])) {
					$order2[].=" email " . $array['al_email'];
				}
				$buildQuery.=$order . implode(", ", $order2);
			}
	
			if (!empty($this->v->_p('post_order_user'))) {
				$_SESSION['order_user_query'] = $buildQuery;
			} else {
				if(!empty($this->v->_s('order_user_query'))){
					$buildQuery = $this->v->_s('order_user_query');
				}
			}
			
			$total = count($this->data->getData($this->db->query("SELECT * FROM " . HASH . "_users " . $buildQuery)));
			$al_fetch_users = $this->data->getData($this->db->query("SELECT * FROM " . HASH . "_users " . $buildQuery . " " . $this->system_pagination->get_pagination($total)));
			$al_fetch_users = empty($al_fetch_users) ? [] : $al_fetch_users;
			return ['rows' => $al_fetch_users, 'total' => $total];
		}
    }
	
	public function countUsers($array = []) {
		$al_fetch_users = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_users')
				->execute()
			);
			
        $al_init_users_rows = count((array) $al_fetch_users);
		$al_init_users_rows = empty($al_init_users_rows) ? "" : $al_init_users_rows;
		return $al_init_users_rows;
	}
}

?>