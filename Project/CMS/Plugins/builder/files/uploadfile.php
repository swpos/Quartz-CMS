<?php
	session_start();
	if(isset($_FILES["file"]["type"])){
		$valid_ext = array("jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		$ext = end($temp);
		if (
			(($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) &&
			in_array($ext, $valid_ext)
		) {
			if ($_FILES["file"]["error"] > 0){
				echo $_FILES["file"]["error"];
			} else {
				if (file_exists('project/images/' . $_SESSION['image_path'] . '/' . $_FILES["file"]["name"])) {
					echo $_FILES["file"]["name"] . " File already exists.";
				} else {
					$source = $_FILES['file']['tmp_name'];
					$target = 'project/images/' . $_SESSION['image_path'] . '/' . $_FILES['file']['name'];
					move_uploaded_file($source, $target);
					echo "File Uploaded<br />";
					echo "File Name: " . $_FILES["file"]["name"] . "<br />";
					echo "Type: " . $_FILES["file"]["type"] . "<br />";
					echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br />";
					echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
				}
			}
		} else {
			echo "Invalid Type or Size";
		}
	}
?>