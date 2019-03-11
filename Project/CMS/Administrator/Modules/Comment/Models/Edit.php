<?php

namespace CMS\Administrator\Modules\Comment\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Edit extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function editComment($array = []) {
		if(count($array) > 0){
			$this->data->updateDatabase($array['data'], $array['where'], 'cms_comments');
		}
	}
}

?>