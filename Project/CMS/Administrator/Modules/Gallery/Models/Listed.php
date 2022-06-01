<?php

namespace CMS\Administrator\Modules\Gallery\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Listed extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function galleryListed($array = []) {
		if(count($array) > 0){
			$buildQuery = "";
			$order = "WHERE";
			$order1 = [];
			if (!empty($array['al_title_search'])) {
				$order1[].=" title LIKE '%" . $this->v->e($array['al_title_search']) . "%'";
			}
			$order1[].=" modules LIKE '%type_gallery%'";
	
			$buildQuery.=$order . implode(" AND ", $order1);
	
			if (!empty($array['al_title']) || !empty($array['al_date']) || !empty($array['al_time'])) {
				$order = " ORDER BY";
				$order2 = [];
				if (!empty($array['al_title'])) {
					$order2[].=" title " . $array['al_title'];
				}
				if (!empty($array['al_time'])) {
					$order2[].=" time " . $array['al_time'];
				}
				if (!empty($array['al_date'])) {
					$order2[].=" date " . $array['al_date'];
				}
				$buildQuery.=$order . implode(", ", $order2);
			}
			if (!empty($this->v->_p('post_order_gallery'))) {
				$_SESSION['order_gallery_query'] = $buildQuery;
			} else {
				if (!empty($this->v->_s('order_gallery_query'))) {					
					$buildQuery = $this->v->_s('order_gallery_query');
				} else {
					$buildQuery = "WHERE modules LIKE '%type_gallery%'";
				}
			}
			
			$total = count((Array) $this->data->getData($this->db->query("SELECT * FROM " . HASH . "_modules " . $buildQuery)));
			$al_fetch_galleries = $this->data->getData($this->db->query("SELECT * FROM " . HASH . "_modules " . $buildQuery . " " . $this->system_pagination->get_pagination($total)));
			$al_fetch_galleries = empty($al_fetch_galleries) ? [] : $al_fetch_galleries;
			return ['rows' => $al_fetch_galleries, 'total' => $total];
		}
    }
}

?>