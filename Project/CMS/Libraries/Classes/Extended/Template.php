<?php

namespace CMS\Libraries\Classes\Extended;

use CMS\Libraries\Classes\Standard as Standard;

class Template extends Standard {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function loaddefaulttemplate() {
		$al_fetch_template = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_template')
				->where('active = ?')
				->andWhere('admin = ?')
				->setParameter(0, '1')
				->setParameter(1, '0')
				->execute()
			);

        $al_title_template = $al_fetch_template->title;
		$al_title_template = empty($al_title_template) ? "" : $al_title_template;
        return $al_title_template;
    }
	
	public function get_template_info($al_value) {
		$al_fetch_template = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_template')
				->where('title = ?')
				->setParameter(0, $al_value)
				->execute()
			);
		
		$al_fetch_template = empty($al_fetch_template) ? array() : $al_fetch_template;
        return $al_fetch_template;
    }

    public function loadfileinfo() {		
		$al_fetch_template = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_template')
				->where('active = ?')
				->andWhere('admin = ?')
				->setParameter(0, "1")
				->setParameter(1, "1")
				->execute()
			);
		$al_title_template = $al_fetch_template->title;
		$al_title_template = empty($al_title_template) ? "" : $al_title_template;
        return $al_title_template;
    }
	
	public function loadtemplatetitle() {
		$al_fetch_template = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_template')
				->where('active = ?')
				->andWhere('admin = ?')
				->setParameter(0, "1")
				->setParameter(1, "0")
				->execute()
			);
		$al_title_template = $al_fetch_template->title;	
		$al_title_template = empty($al_title_template) ? "" : $al_title_template;
        return $al_title_template;
    }

}

?>