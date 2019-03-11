<?php

namespace CMS\Administrator\Modules\Menu\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Edit extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
	}
	
	public function getMenuLinksByIndex($array = []) {
		if(count($array) > 0){
			$al_fetch_link_menu = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_link_menu')
					->where('id_index = ?')
					->orderBy('order1', 'ASC')
					->setParameter(0, $array['id'])
					->execute()
				);
				
			$al_fetch_link_menu = empty($al_fetch_link_menu) ? [] : $al_fetch_link_menu;
			return $al_fetch_link_menu;
		}
	}
	
	public function getMenuLinksByIdIndex($array = []) {
		if(count($array) > 0){
			$al_fetch_link_menu = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_link_menu')
					->where('id = ?')
					->andWhere('id_index = ?')
					->orderBy('order1', 'ASC')
					->setParameter(0, $array['al_id_index'])
					->setParameter(1, $array['al_id_link'])
					->execute()
				);

			$al_fetch_link_menu = empty($al_fetch_link_menu) ? [] : $al_fetch_link_menu;
			return $al_fetch_link_menu;
		}
	}
	
	public function getSectionMenuLinks($array = []) {
		if(count($array) > 0){
			$al_fetch_link_menu = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_link_menu')
					->where('id_index = ?')
					->orWhere('id_index = ?')
					->orderBy('order1', 'ASC')
					->setParameter(0, $array['id'])
					->setParameter(1, '')
					->execute()
				);
			
			$al_fetch_link_menu = empty($al_fetch_link_menu) ? [] : $al_fetch_link_menu;
			return $al_fetch_link_menu;
		}
	}
	
	public function getSectionById($array = []) {
		if(count($array) > 0){
			$al_fetch_section_name = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_section_name')
					->where('id = ?')
					->setParameter(0, $array['id'])
					->execute()
				);
			
			$al_fetch_section_name = empty($al_fetch_section_name) ? [] : $al_fetch_section_name;
			return $al_fetch_section_name;
		}
	}
	
	public function getSections($array = []) {
		$al_fetch_section_name = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_section_name')
				->execute()
			);

		$al_fetch_section_name = empty($al_fetch_section_name) ? [] : $al_fetch_section_name;
		return $al_fetch_section_name;
	}
	
	public function updateMenuLinkStandard($array = []) {
		if(count($array) > 0){
			$this->data->updateDatabase($array['data'], $array['where'],  HASH.'_link_menu');
		}
	}
	
	public function updateSectionStandard($array = []) {
		if(count($array) > 0){
			$this->data->updateDatabase($array['data'], $array['where'],  HASH.'_section_name');
		}
	}
	
	public function deleteLinkMenu($array = []) {
		if(count($array) > 0){
			$this->data->deleteEntry($array, HASH.'_link_menu');
		}
	}	
	
	public function getModulesWithShortcut($array = []) {
		if(count($array) > 0){
			$al_fetch_link_menu = 
				$this->data->getData(
					$this->db->createQueryBuilder()
					->select('*')
					->from(HASH.'_modules')
					->where('shortcut LIKE ?')
					->setParameter(0, '%'.$array['shortcut'].'%')
					->execute()
				);
			
			return $al_fetch_link_menu;
		}
	}	
}

?>