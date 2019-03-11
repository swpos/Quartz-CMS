<?php

namespace CMS\Administrator\Modules\Module\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Listed extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function getModulesList($array = []) {
		if(count($array) > 0){
			$buildQuery = "";
			if (!empty($array['al_type']) || !empty($array['al_search']) || !empty($array['al_position_type']) || !empty($array['al_published'])) {
				$order = "WHERE";
				$order1 = [];
				if (!empty($array['al_search'])) {
					$order1[].=" category LIKE '%" . $this->v->e($array['al_search']) . "%'";
				}
				if (!empty($array['al_type'])) {
					$order1[].=" modules LIKE '%" . $array['al_type'] . "%'";
				}
				if (!empty($array['al_position_type'])) {
					$order1[].=" position = '" . $array['al_position_type'] . "'";
				}
				if (!empty($array['al_published'])) {
					if ($array['al_published'] == 'yes') {
						$array['al_published'] = "1";
					} else {
						$array['al_published'] = "0";
					}
					$order1[].=" published = '" . $array['al_published'] . "'";
				}
				$buildQuery.=$order . implode(" AND ", $order1);
			}
	
			if (!empty($array['al_category']) || !empty($array['al_order']) || !empty($array['al_time']) || !empty($array['al_date']) || !empty($array['al_position'])) {
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
				if (!empty($array['al_position'])) {
					$order2[].=" position " . $array['al_position'];
				}
				$buildQuery.=$order . implode(", ", $order2);
			}
			if (!empty($this->v->_p('post_order_module'))) {
				$_SESSION['order_module_query'] = $buildQuery;
			} else {
				if(!empty($this->v->_s('order_module_query'))){
					$buildQuery = $this->v->_s('order_module_query');
				}
			}
			$total = count($this->data->getData($this->db->query("SELECT * FROM " . HASH . "_modules " . $buildQuery)));
			$al_fetch_modules = $this->data->getData($this->db->query("SELECT * FROM " . HASH . "_modules " . $buildQuery . " " . $this->system_pagination->get_pagination($total)));
			$al_fetch_modules = empty($al_fetch_modules) ? [] : $al_fetch_modules;
			return ['rows' => $al_fetch_modules, 'total' => $total];
		}
    }
	
	public function moduleCount($array = []) {
		$al_fetch_module = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_modules')
				->execute()
			);

        $al_init_modules_rows = count((array) $al_fetch_module);
		$al_init_modules_rows = empty($al_init_modules_rows) ? "" : $al_init_modules_rows;
		return $al_init_modules_rows;
	}
	
	public function getModules($array = []) {
		$query = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_modules')
				->execute()
			);
		
		return $query;
	}
	
	public function getPlugins($array = []) {
		$plugins = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_plugins')
				->execute()
			);
			
		$plugins = empty($plugins) ? [] : $plugins;
		return $plugins;
	}
	
	public function deleteSectionByModuleId($array = []) {
		if(count($array) > 0){
			$this->data->deleteEntry($array, HASH.'_section_name');
		}
	}
	
	public function deleteCategory($array = []) {
		if(count($array) > 0){
			$this->data->deleteEntry($array, HASH.'_category');
		}
	}
	
	public function deleteModule($array = []) {
		if(count($array) > 0){
			$this->data->deleteEntry($array, HASH.'_modules');
		}
	}
}

?>