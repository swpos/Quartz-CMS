<?php

	function media ($al_connexion) {
		return render(array('al_connexion' => $al_connexion), 'media', 'media_upload');
	}
	
	function media_show ($al_connexion) {
		$al_dir  = '../media/thumbnail';
		$al_get_folders = scandir($al_dir);
		
		return render(array('al_connexion' => $al_connexion, 'al_get_folders' => $al_get_folders), 'media', 'show_media');
	}
	
	function delete_media_show ($al_connexion) {
		$images= (isset($_POST['images']) ? $_POST['images'] : array());
		foreach($images as $key => $value){
			unlink('../media/'.$value);
			unlink('../media/thumbnail/'.$value);
		}
	}
?>