<?php

namespace CMS\Libraries\Classes\Extended;

use CMS\Libraries\Classes\Standard as Standard;

class Plugins extends Standard {

    public function __construct($container) {
		parent::__construct($container);
    }

    public function check_plugin() {
        $plugins = array();
		
		$al_fetch_plugins = 
			$this->data->getData(
				$this->db->createQueryBuilder()
				->select('*')
				->from(HASH.'_plugins')
				->execute()
			);

        foreach ((is_array($al_fetch_plugins) ? $al_fetch_plugins : array($al_fetch_plugins)) as $plugin) {
            $plugin_name = $plugin->content;
            $plugin_publish = $plugin->publish;
            if ($plugin_publish == 1) {
                $plugins[] = $plugin_name;
            }
        }
		$plugins = empty($plugins) ? array() : $plugins;
        return $plugins;
    }

}

?>