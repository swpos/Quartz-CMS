<?php

namespace CMS\Administrator\Modules\Plugin\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Listed extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function pluginsList($array = []) {
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
	
			if (!empty($array['al_title']) || !empty($array['al_time']) || !empty($array['al_date'])) {
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
			if (!empty($this->v->_p('post_order_plugin'))) {
				$_SESSION['order_plugin_query'] = $buildQuery;
			} else {
				if(!empty($this->v->_s('order_plugin_query'))){
					$buildQuery = $this->v->_s('order_plugin_query');
				}
			}
			
			$total = count($this->data->getData($this->db->query("SELECT * FROM " . HASH . "_plugins " . $buildQuery)));
			$al_fetch_plugins = $this->data->getData($this->db->query("SELECT * FROM " . HASH . "_plugins " . $buildQuery . " " . $this->system_pagination->get_pagination($total)));
			$al_fetch_plugins = empty($al_fetch_plugins) ? [] : $al_fetch_plugins;
			return ['rows' => $al_fetch_plugins, 'total' => $total];
		}
    }
	
	public function countPlugins($array = []) {
		$al_fetch_plugins = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_plugins')
				->execute()
			);
			
        $al_init_plugins_rows = count((array) $al_fetch_plugins);
		$al_init_plugins_rows = empty($al_init_plugins_rows) ? "" : $al_init_plugins_rows;
		return $al_init_plugins_rows;
    }
	
	public function getPluginById($array = []) {
		if(count($array) > 0){
			$al_fetch_plugins = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_plugins')
					->where('id = ?')
					->setParameter(0, $array['id'])
					->execute()
				);
				
			$al_fetch_plugins = empty($al_fetch_plugins) ? [] : $al_fetch_plugins;
			return $al_fetch_plugins;
		}
    }
	
	public function deletePluginTable($array = []) {
		if(count($array) > 0){
			$this->db->query("DROP TABLE " . $array['value']);
		}
    }
	
	public function deletePlugin($array = []) {
		if(count($array) > 0){
			$this->data->deleteEntry($array, HASH.'_plugins');
		}
    }
	
	public function updatePlugin($array = []) {
		if(count($array) > 0){
			$this->data->updateDatabase($array['data'], $array['where'],  HASH.'_plugins');
		}	
	}
}

?>