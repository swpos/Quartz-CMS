<?php
$content = isset($_POST['content']) ? $_POST['content'] : '';
$css_file = isset($_POST['css_file']) ? $_POST['css_file'] : '';
$bootstrap = isset($_POST['bootstrap']) ? $_POST['bootstrap'] : '';
$template = isset($_POST['template']) ? $_POST['template'] : '';
$pathImages = isset($_POST['pathImages']) ? $_POST['pathImages'] : '';
$folder_name = md5(rand(0,1000000)).'-'.date('Y-m-d');

// Copy Template
if(!function_exists('cpy')){
	function cpy($source, $dest) {
		if (is_dir($source)) {
			$dir_handle = opendir($source);
			while ($file = readdir($dir_handle)) {
				if ($file != "." && $file != "..") {
					if (is_dir($source . "/" . $file)) {
						if(!file_exists($dest . "/" . $file)){
							mkdir($dest . "/" . $file);
						}
						cpy($source . "/" . $file, $dest . "/" . $file);
					} else {
						copy($source . "/" . $file, $dest . "/" . $file);
					}
				}
			}
			closedir($dir_handle);
		} else {
			copy($source, $dest);
		}
	}
}

if(!function_exists('rrmdir')){
	function rrmdir($dir) {
		foreach (glob($dir . '/*') as $file) {
			if (is_dir($file))
				rrmdir($file);
			else
				unlink($file);
		}
		rmdir($dir);
	}
}


mkdir('cache/'.$folder_name);

if(is_dir('cache/'.$folder_name)){
	cpy('project', 'cache/'.$folder_name.'/');
}

if(is_dir('cache/'.$folder_name.'/images')){
	rrmdir('cache/'.$folder_name.'/images/');
}

if(is_dir('cache/'.$folder_name)){
	mkdir('cache/'.$folder_name.'/images');
	mkdir('cache/'.$folder_name.'/images/'.$pathImages);
}

if(is_dir('project/images/'.$pathImages) && is_dir('cache/'.$folder_name.'/images/'.$pathImages)){
	cpy('project/images/'.$pathImages, 'cache/'.$folder_name.'/images/'.$pathImages.'/');
	rrmdir('project/images/'.$pathImages.'/');
}

if(file_exists('project/style/edits/'.$css_file)){
	unlink('project/style/edits/'.$css_file);
}

if($template != ''){
	cpy('cache/'.$template.'/images', "cache/".$folder_name."/images/");
	
	if(is_dir('cache/'.$template)){
		rrmdir('cache/'.$template.'/');
	}
	if(file_exists('cache/'.$template.'.zip')){
		unlink('cache/'.$template.'.zip');
	}
}

// Rewrite index
$content = str_replace('<a class="delete-item">Delete</a>', '', $content);
$content = str_replace('<a class="delete-item" href="#">Delete Section</a>', '', $content);
$content = str_replace('<a class="delete-item" href="#">Delete Row</a>', '', $content);
$content = str_replace("\n", "", $content);
$content = str_replace("\r", "", $content);
$content = str_replace("\t", "", $content);

$get_content = file_get_contents('cache/'.$folder_name.'/index.php', true);
$get_content = str_replace("{theme_css}", "style/edits/custom.css", $get_content);
$get_content = str_replace("{bootstrap_css}", $bootstrap, $get_content);
$get_content = str_replace("<div class=\"theme_content\"></div>", $content, $get_content);

$handle = fopen('cache/'.$folder_name.'/index.php', 'w');
fwrite($handle, $get_content);
fclose($handle);

//Delete all extra css and rename css
$css_folder = 'cache/'.$folder_name.'/style/edits/'; 
$files = scandir($css_folder);
foreach($files as $key => $file) {
	if($file != '.' && $file != '..'){
		if($file != $css_file){
			unlink($css_folder.$file);
		} else {
			rename ($css_folder.$file, $css_folder.'custom.css');
		}
	}
}

// ZIP Archive
$rootPath = realpath('cache/'.$folder_name);
$zip = new ZipArchive();
$zip->open('cache/'.$folder_name.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);
foreach ($files as $name => $file){
    if (!$file->isDir()){
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);
        $zip->addFile($filePath, $relativePath);
    }
}
$zip->close();

echo json_encode(array('success'=> true, 'file'=> $folder_name.'.zip'));

?>