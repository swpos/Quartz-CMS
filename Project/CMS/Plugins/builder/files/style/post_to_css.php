<?php
$path = isset($_POST['path']) ? $_POST['path'] : '';
$css = isset($_POST['css']) ? $_POST['css'] : '';
$file = isset($_POST['file']) ? $_POST['file'] : '';

$build_css = array();

foreach($css as $key => $value){
	$build_css[] = "\t".$value;
}

$check_is = 0;
$build = "\n". $path. " {\n". implode("\n", $build_css) . "\n}\n";
$file_content = file_get_contents('../project/style/edits/'.$file, true);
$split = explode('/**/', $file_content);
foreach($split as $key => $value){
	if(strpos($value, $path . ' {') !== false){
		$split[$key] = $build;
		$check_if = 1;
	}
}

if($check_if == 0){
	$file_content = $file_content."\n/**/".$build;
} else {
	$file_content = implode('/**/', $split);
}

$handle = fopen('../project/style/edits/'.$file, 'w');
fwrite($handle, $file_content);
fclose($handle);
echo json_encode(array('success'=> true));
?>