<?php
	function cpanel ($al_connexion) {
		return render(array('al_connexion' => $al_connexion), 'panel', 'panel');
	}
?>