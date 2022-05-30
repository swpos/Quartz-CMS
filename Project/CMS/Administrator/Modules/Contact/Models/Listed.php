<?php

namespace CMS\Administrator\Modules\Contact\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Listed extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function contactListed($array = []) {
		if(count($array) > 0){
			$buildQuery = "";
			if (!empty($array['al_gender']) || !empty($array['al_email_search'])) {
				$order = "WHERE";
				$order1 = [];
	
				if (!empty($array['al_gender'])) {
					$order1[].=" gender LIKE '%" . $this->v->e($array['al_gender']) . "%'";
				}
				if (!empty($array['al_email_search'])) {
					$order1[].=" email LIKE '%" . $this->v->e($array['al_email_search']) . "%'";
				}
				$buildQuery.=$order . implode(" AND ", $order1);
			}
	
			if (!empty($array['al_email']) || !empty($array['al_first_name']) || !empty($array['al_last_name']) || !empty($array['al_phone'])) {
				$order = " ORDER BY";
				$order2 = [];
				if (!empty($array['al_email'])) {
					$order2[].=" email " . $array['al_email'];
				}
				if (!empty($array['al_first_name'])) {
					$order2[].=" first_name " . $array['al_first_name'];
				}
				if (!empty($array['al_last_name'])) {
					$order2[].=" last_name " . $array['al_last_name'];
				}
				if (!empty($array['al_phone'])) {
					$order2[].=" phone " . $array['al_phone'];
				}
				if (!empty($array['al_date'])) {
					$order2[].=" date " . $array['al_date'];
				}
				if (!empty($array['al_time'])) {
					$order2[].=" time " . $array['al_time'];
				}
				$buildQuery.=$order . implode(", ", $order2);
			}
			if (!empty($this->v->_p('post_order_contact'))) {
				$_SESSION['order_contact_query'] = $buildQuery;
			} else {
				if(!empty($this->v->_s('order_contact_query'))){
					$buildQuery = $this->v->_s('order_contact_query');
				}
			}
			$total = count((Array) $this->data->getData($this->db->query("SELECT * FROM cms_contact " . $buildQuery)));
			$al_fetch_contacts = $this->data->getData($this->db->query("SELECT * FROM cms_contact " . $buildQuery . " " . $this->system_pagination->get_pagination($total)));
			$al_fetch_contacts = empty($al_fetch_contacts) ? [] : $al_fetch_contacts;
			return ['rows' => $al_fetch_contacts, 'total' => $total];
		}
    }
	
	public function countContacts($array = []) {
		$al_fetch_contacts = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from('cms_contact')
				->execute()
			);

        $al_init_contact_rows = count((array) $al_fetch_contacts);
		$al_init_contact_rows = empty($al_init_contact_rows) ? "" : $al_init_contact_rows;
		return $al_init_contact_rows;
	}
		
	public function contactAdminUpdate($array = []) {
		if(count($array) > 0){
			if (!empty($array['data'])) {
				$this->data->updateDatabase($array['data'], $array['where'],  'cms_contact_config');
			}
		}
	}
	
	public function getContactConfig($array = []) {
		$al_fetch_contact_config = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from('cms_contact_config')
				->execute()
			);
			
		$al_fetch_contact_config = empty($al_fetch_contact_config) ? [] : $al_fetch_contact_config;
		return $al_fetch_contact_config;
	}
	
	public function getContact($array = []) {
		if(count($array) > 0){
			$al_fetch_contact = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('c.id, c.id_module, c.date, c.time, c.first_name, c.last_name, c.email, c.phone, c.postal_code, c.city, c.states, c.country, c.daybirth, c.monthbirth, c.yearbirth, c.gender, c.content, m.shortcut')
					->from(HASH.'_modules', 'm')
					->innerJoin('m', 'cms_contact', 'c', 'c.id_module = m.id')
					->where('c.id = ?')
					->setParameter(0, $array['id'])
					->execute()					
				);
				
			$al_fetch_contact = empty($al_fetch_contact) ? [] : $al_fetch_contact;
			return $al_fetch_contact;
		}
	}
	
	public function deleteContact($array = []) {
		if(count($array) > 0){
			$this->data->deleteEntry($array, 'cms_contact');
		}
	}
}

?>