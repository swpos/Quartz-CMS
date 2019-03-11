<?php

$css_file = isset($_POST['css_file']) ? $_POST['css_file'] : '';
$pathImages = isset($_POST['pathImages']) ? $_POST['pathImages'] : '';

function rrmdir($dir) {
	foreach (glob($dir . '/*') as $file) {
		if (is_dir($file))
			rrmdir($file);
		else
			unlink($file);
	}
	rmdir($dir);
}


if(is_dir('project/images/'.$pathImages)){
	rrmdir('project/images/'.$pathImages.'/');
}

if(file_exists('project/style/edits/'.$css_file)){
	unlink('project/style/edits/'.$css_file);
}

echo json_encode(array('success'=> true));

?>