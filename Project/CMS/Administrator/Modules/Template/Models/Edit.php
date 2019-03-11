<?php

namespace CMS\Administrator\Modules\Template\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Edit extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }
	
	public function updateTemplate($array = []) {
		if(count($array) > 0){
			$this->data->updateDatabase($array['data'], $array['where'],  HASH.'_template');
		}
	}
}

?>