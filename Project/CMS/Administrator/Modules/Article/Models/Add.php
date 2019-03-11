<?php

namespace CMS\Administrator\Modules\Article\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Add extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function addArticle($array = []) {
		if(count($array) > 0){
			$this->data->insertIntoDatabase($array, HASH."_articles");
		}
    }	
}

?>