<?php

namespace CMS\Administrator\Modules\Plugin\Models;

use CMS\Administrator\Functions\Load\Module as ModuleExtended;

class Add extends ModuleExtended {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function run_sql_file_unknown($array = []) {
		if(count($array) > 0){
			$this->db->query($array['command']);
		}
    }
	
	public function pluginUpload($array = []) {
		if(count($array) > 0){
			$this->data->insertIntoDatabase($array, HASH."_plugins");
		}
    }	
}

?>