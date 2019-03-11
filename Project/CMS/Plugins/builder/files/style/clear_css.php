<?php
$file = isset($_POST['file']) ? $_POST['file'] : '';

$handle = fopen('../project/style/edits/'.$file, 'w');
fwrite($handle, '/**/');
fclose($handle);

echo json_encode(array('success'=> true));
?>