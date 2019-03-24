<?php
$filename = isset($_POST['file']) ? $_POST['file'] : '';
$element = isset($_POST['element']) ? $_POST['element'] : '';
$get_content = file_get_contents('../project/style/edits/'.$filename, FILE_USE_INCLUDE_PATH);
$get_content = explode("\n", $get_content);
$i = 0;
$j = 0;
$new_array = array();
foreach($get_content as $key => $value) {
	if($i == 1 && strpos($value, '}') === false) {
		if(!empty(trim($value))){
			$property = explode(':', trim($value));
			$new_array[$property[0]] = rtrim($property[1], ';'); 
		}
	}
	
	if(strpos($value, $element) !== false){
		$i = 1;
	}
	
	if($i == 1 && strpos($value, '}') !== false){
		break;
	}
}

echo json_encode(array('array'=> $new_array));
?>