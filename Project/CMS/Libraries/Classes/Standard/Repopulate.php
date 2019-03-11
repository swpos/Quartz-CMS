<?php

namespace CMS\Libraries\Classes\Standard;

class Repopulate {

    public function repopulateform($al_array) {
        foreach ($al_array as $al_key => $al_value) {
			$_SESSION['populate'][$al_key] = $al_value;
        }
    }
}

?>