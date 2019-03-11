<?php

namespace CMS\Libraries\Classes\Extended;

use CMS\Libraries\Classes\Standard as Standard;

class Shortcut extends Standard {

    public function __construct($container) {
		parent::__construct($container);
    }
    
    public function insert_module($title, $array = array()) {
		$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : "";
        if (empty($_SESSION['error_message'])) {
			$al_fetch_modules = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_modules')
					->where('title = ?')
					->setParameter(0, $title)
					->execute()
				);
			
            $al_fetch_modules = count($al_fetch_modules);
            if (($al_fetch_modules < 0) || ($al_fetch_modules == 0)) {
                return $this->data->insertIntoDatabase($array, HASH."_modules");
            }
        }
    }
	
	public function edit_module($array = array()) {
		$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : "";
        if (empty($_SESSION['error_message'])) {
			$al_fetch_modules = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_modules')
					->where('title = ?')
					->andWhere('id != ?')
					->setParameter(0, $array['module']['data']['title'])
					->setParameter(1, $array['module']['where']['id'])
					->execute()
				);
			
            $al_fetch_modules = count($al_fetch_modules);
            if (($al_fetch_modules < 0) || ($al_fetch_modules == 0)) {
				if(isset($array['category']['data'])){
                	$this->data->updateDatabase($array['category']['data'], $array['category']['where'], HASH.'_category');
				}
				$this->data->updateDatabase($array['module']['data'], $array['module']['where'], HASH.'_modules');
            }
        }
    }

    public function post_module_custom($value, $error, $extra) {
        if (empty($error) && !empty($value)) {
			$this->data->updateDatabase($value['data'], $value['where'],  HASH.'_modules');
        }
    }

    public function get_section($al_id) {
		$al_fetch_section_name = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_section_name')
				->where('id_module = ?')
				->setParameter(0, $al_id)
				->execute()
			);

		$al_fetch_section_name = empty($al_fetch_section_name) ? array() : $al_fetch_section_name;
        return $al_fetch_section_name;
    }

    public function get_links($al_id_menu) {
		$al_fetch_link_menu = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_link_menu')
				->where('id_index = ?')
				->setParameter(0, $al_id_menu)
				->execute()
			);
		
		$al_fetch_link_menu = empty($al_fetch_link_menu) ? array() : $al_fetch_link_menu;
        return $al_fetch_link_menu;
    }
	
	public function gen_descAsc ($name){
		$content = "";
		$value = isset($_SESSION['populate'][$name]) ? $_SESSION['populate'][$name] : '';
		$content .= "<option value='DESC'";
		if ($value == "DESC"):
			$content .=" selected='selected' ";
		endif;
		$content .= ">".DESCENDING."</option>\n";
		
		$content .= "<option value='ASC'";
		if ($value == "ASC"):
			$content .=" selected='selected' ";
		endif;
		$content .= ">".ASCENDING."</option>\n";
				
		return $content;
	}
	
	public function gen_pubUnpub ($name){
		$content = "";
		$value = isset($_SESSION['populate'][$name]) ? $_SESSION['populate'][$name] : '';
		$content .= "<option value='yes'";
		if ($value == "yes"):
			$content .=" selected='selected' ";
		endif;
		$content .= ">".ucfirst(PUBLISH_OPTION_PUBLISHED)."</option>\n";
		
		$content .= "<option value='no'";
		if ($value == "no"):
			$content .=" selected='selected' ";
		endif;
		$content .= ">".ucfirst(PUBLISH_OPTION_UNPUBLISHED)."</option>\n";
				
		return $content;
	}
}

?>