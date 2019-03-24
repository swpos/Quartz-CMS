<?php 
echo"<option value=\"\"></option>";
$start_value = isset($_GET['start_value']) ? $_GET['start_value'] : '';
$pathImages = isset($_GET['pathImages']) ? $_GET['pathImages'] : '';
$folder = '../../project/images/'.$pathImages.'/'; 
$files = scandir($folder);
foreach($files as $key => $file) {
	if($file != '.' && $file != '..'){
		if(!is_dir($folder.$file)){
			echo "<option value=\"url('../../images/".$pathImages."/".$file."')\"";
			if($start_value == 'url(\'../../images/'.$pathImages.'/'.$file.'\')') { echo " selected=\"selected\""; }
			echo">".substr($file, 0, 40)."</option>";
		}
	}
}

?>