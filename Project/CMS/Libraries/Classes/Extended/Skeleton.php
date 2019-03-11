<?php

namespace CMS\Libraries\Classes\Extended;

use CMS\Libraries\Classes\Standard as Standard;

class Skeleton extends Standard {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function menu_params($id = null) {
		$al_fetch_section_name = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_section_name')
				->where('id_module = ?')
				->setParameter(0, $id)
				->execute()
			);

        $info = array();
        $info['id'] = $al_fetch_section_name->id;
        $info['section'] = $al_fetch_section_name->section;
        $info['id_module'] = $al_fetch_section_name->id_module;
		$info = empty($info) ? array() : $info;
        return $info;
    }

    public function menu_item_params($id = null) {
		$query = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_link_menu')
				->where('id_index = ?')
				->andWhere('published = ?')
				->orderBy('order1', 'ASC')
				->setParameter(0, $id)
				->setParameter(1, '1')
				->execute()
			);
				
        $total = array();
        foreach ((is_array($query) ? $query : array($query)) as $al_fetch_section_name) {
            $info = array();
            $info['id'] = $al_fetch_section_name->id;
            $info['id_index'] = $al_fetch_section_name->id_index;
            $info['name'] = $al_fetch_section_name->name;
            $info['shortcut'] = $al_fetch_section_name->shortcut;
            $info['order1'] = $al_fetch_section_name->order1;
            $info['sub_menu'] = $al_fetch_section_name->sub_menu;
            $info['register'] = $al_fetch_section_name->register;
            $total[] = $info;
        }
		$total = empty($total) ? array() : $total;
        return $total;
    }
	
	public function create_menu_structure($id) {
		$page = isset($_GET['page']) ? $_GET['page'] : '/';
        $menu_item_info = $this->menu_item_params($id);
		if(!empty($menu_item_info)){
			$content = "<ul class=\"dropdown-menu\">";
			foreach ($menu_item_info as $key => $value) {
				if($value['register'] == 1 && empty($_SESSION['pseudom'])){ continue; } 
				$dropdown ='';
				$active = '';
				$extra_current = '';
				$link = '';
				$extra = '';
				$extra_icon = '';
				
				if($page == $value['shortcut']){ 
					$active = "active"; 
					$extra_current = '<span class="sr-only">(current)</span>';
				}
				if($value['sub_menu'] != 0){ $dropdown = "dropdown"; }
				if($value['sub_menu'] != 0){ 
					$link = "#"; 
					$extra = 'class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"';
					$extra_icon = '<span class="caret"></span>';
				} else { 
					$link = $value['shortcut']; 
				}
				
				$content .="<li class=\"".$active." ".$dropdown."\"><a href='" . $link . "' ".$extra.">" . $value['name'].$extra_current.$extra_icon. "</a>";
				if ($value['sub_menu'] != 0) {
					$content .= $this->create_menu_structure($value['sub_menu']);
				}
				$content .="</li>";
			}
			$content .="</ul>";
			return $content;
		}
    }

}

?>