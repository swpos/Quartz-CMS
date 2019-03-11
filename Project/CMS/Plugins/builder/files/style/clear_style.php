<?php
$path = isset($_POST['path']) ? $_POST['path'] : '';
$file = isset($_POST['file']) ? $_POST['file'] : '';

$file_content = file_get_contents('../project/style/edits/'.$file, true);
$split = explode('/**/', $file_content);
foreach($split as $key => $value){
	if(strpos($value, $path . ' {') !== false){
		unset($split[$key]);
	}
}

$file_content = implode('/**/', $split);

$handle = fopen('../project/style/edits/'.$file, 'w');
fwrite($handle, $file_content);
fclose($handle);
echo json_encode(array('success'=> true));
?>