<?php
	if(in_array('builder', $plugins) && $editor == 'builder' && strpos($_SERVER['REQUEST_URI'], 'Administrator/') !== false) {
?>
	<link rel="stylesheet" type="text/css" href="../Plugins/builder/files/style/style.css" />
	<link rel="stylesheet" type="text/css" href="../Plugins/builder/files/style/grid.css" />
    <script type="text/javascript" src="../Plugins/builder/files/widgets/Magnific-Popup/dist/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="../Plugins/builder/files/js/property.js"></script>
    <script type="text/javascript" src="../Plugins/builder/files/js/export.js"></script>
    <script type="text/javascript" src="../Plugins/builder/files/js/rightclickmenu.js"></script>
    <script type="text/javascript" src="../Plugins/builder/files/js/tabs.js"></script>
<?php	
	}
	if(strpos($_SERVER['REQUEST_URI'], 'Administrator/') === false){
?>
	<link rel="stylesheet" type="text/css" href="Plugins/builder/files/project/style/custom.css" />
<?php
		$folder = "Plugins/builder/files/cache"; 
		$folder = scandir($folder);
					
		foreach($folder as $target) {
			if($target == '.' || $target == '..' || $target == 'index.html' || strpos($target, '.zip') !== false){} else {
				?>
					<link rel="stylesheet" type="text/css" href="Plugins/builder/files/cache/<?php echo $target; ?>/style/edits/custom.css" />
				<?php
			}
		}
	}
?>
