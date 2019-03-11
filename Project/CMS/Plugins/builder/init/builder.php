<?php
	if(in_array('builder', $plugins) && $editor == 'builder' && strpos($_SERVER['REQUEST_URI'], 'Administrator/') !== false) {
?>
	<?php 
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
	
		$image_folder = "../Plugins/builder/files/project/images"; 
		$folders = scandir($image_folder);
		$current_date = date("Ymd", strtotime('-1 day', time()));
		
		foreach($folders as $target) {
			if($target == '.' || $target == '..' || $target == 'index.html'){} else {
				$file_date = date("Ymd", filemtime($image_folder.'/'.$target));
				if($file_date < $current_date){
					rrmdir($image_folder.'/'.$target.'/');
				}
			}
		}
		
		$css_folder = "../Plugins/builder/files/project/style/edits"; 
		$folders = scandir($css_folder);
					
		foreach($folders as $target) {
			if($target == '.' || $target == '..' || $target == 'index.html'){} else {
				$file_date = date("Ymd", filemtime($css_folder.'/'.$target));
				if($file_date < $current_date){
					unlink($css_folder.'/'.$target);
				}
			}
		}
	?>
	<?php 
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
	
		$string = md5(rand(0,1000000));
		$_SESSION['image_path'] = $string;
		mkdir("../Plugins/builder/files/project/images/".$string);
		$filename = $string.".css";
		$filename_path = "../Plugins/builder/files/project/style/edits/".$filename;
		$handle = fopen($filename_path, "a");
		if(isset($_GET['template'])){
			$template = $_GET['template'];
			$css_new_content = file_get_contents("../Plugins/builder/files/cache/".$_GET['template']."/style/edits/custom.css", true);
			$css_new_content = explode('/',$css_new_content);
			foreach($css_new_content as $key => $value){
				if(isset($css_new_content[$key - 1]) && $css_new_content[$key - 1] == 'images') {
					$css_new_content[$key] = $string;
				}
			}
			$css_new_content = implode('/',$css_new_content);
			fwrite($handle, $css_new_content);
			
			$folders = scandir('../Plugins/builder/files/cache/'.$_GET['template'].'/images');
			foreach($folders as $target) {
				if($target == '.' || $target == '..' || $target == 'index.html'){} else {
					cpy('../Plugins/builder/files/cache/'.$_GET['template'].'/images/'.$target, '../Plugins/builder/files/project/images/'.$string.'/');
				}
			}
			
			$cache_content = file_get_contents('../Plugins/builder/files/cache/'.$_GET['template'].'/index.php', true);
			preg_match("/<body[^>]*>(.*?)<\/body>/is", $cache_content, $matches);
        } else {
			$template = '';
			fwrite($handle, "/**/");
		}
		fclose($handle);
	?>
	<script type="text/javascript">
		$(document).ready(function () {				
			$('.menu-toggle').on('click', function() {
				$('.slide-menu').animate({
					left: '0'
				}, 300);
				$('.overlay').css('display', 'block');
			});
			$('.slide-menu a').on('click', function() {
				$('.slide-menu').animate({
					left: '-256px'
				}, 300);
				$('.overlay').css('display', 'none');
			});
			
			$('body').attr('oncontextmenu','return false;');
			$('.widgets').rightclickmenu2();
			
			$("body iframe.content").on("load", function () {
				var $head = $(this).contents().find("head");  
				<?php if(isset($_GET['template'])){ ?>
					$head.append($("<link/>", { rel: "stylesheet", href: "{theme_css}", type: "text/css" }));
					$head.find('.theme_css').remove();
				
					var $body = $(this).contents().find("body");
					$body.html("<?php echo preg_replace( "/\r|\n/", "", trim(str_replace('"','\"', $matches[1]))); ?>"); 
				<?php } ?>
				$head.append($("<link/>", { rel: "stylesheet", href: "style/edits/<?php echo $filename; ?>", type: "text/css" }));
				$head.append($("<link/>", { rel: "stylesheet", class: "grid", href: "style/grid.css", type: "text/css" }));
				
				$("body iframe.content").contents().find('body').find('#page').delegate('.delete-item', 'click', function() {
					$(this).parent().remove();
				});
				$(".reload-js").click(function() {
					var iframe = document.getElementById("content");
					if (iframe) {
					   var iframeContent = (iframe.contentWindow || iframe.contentDocument);
					 
					   iframeContent.loadScripts();
					}
				});
				
				$('body').append($('<div class="tool-tip"></div>'));
				var $this = $(this);
				$(this).contents().find('body').bind('mousemove', function (event) {
					$('.tool-tip').css('display', 'block');
					$('.tool-tip').toolTipNode($this.contents(), event, $("body iframe.content"));
				}).bind('mouseleave', function (event) {
					$('.tool-tip').css('display', 'none');
				});
				
				$(this).contents().find('body').attr('oncontextmenu','return false;');
				$(this).contents().find('body').rightclickmenu('<?php echo $filename ?>', '<?php echo $string; ?>');
				
				$(".reload-css").click(function() {
					$(this).reloadStylesheets('style/edits/');
				});
				
				$(".clear-css").click(function() {
					$(this).clearCSS('<?php echo $filename; ?>');
				});
				
				$(".saveFiles").click(function() {
					var bootstrap_theme = $head.find(".bootstrap").attr('href');   
					$(this).exporting('<?php echo $filename; ?>', bootstrap_theme, '<?php echo $template; ?>', '<?php echo $string; ?>');
				});
				
				$(".use-as-content").click(function() {
					var content_body = $(this).use_content();
					$('textarea#editor').html(content_body);
				});
				
				$(".getFiles").click(function(e) {
					e.preventDefault();
					window.location.href = '../Plugins/builder/files/cache/'+ $(this).prev().val() + '.zip';
				});
				
				$(".switch-template").click(function(e) {
					var $this = $(this);
					e.preventDefault();
					var data_to_send = {
						css_file: '<?php echo $filename; ?>',
						pathImages: '<?php echo $string; ?>'
					};
					
					$.ajax({
						method: "POST",
						url: "../Plugins/builder/files/cleanoldfiles.php",
						data: data_to_send,
						dataType: 'json',
						success: function (data) {
							$this.closest('form').submit();
						}
					});
				});
				
				$(".grid-disabled").click(function() {
					var grid = $head;
					if(grid.find('.grid').length){
						grid.find('.grid').remove();
					} else {
						grid.append($("<link/>", { rel: "stylesheet", class: "grid", href: "style/grid.css", type: "text/css" }));
					}
				});
				
				$(".delete-understand").click(function() {
					$(this).closest('div.understand').remove();
				});
			});
			
		});
	</script>
<?php	
	}
?>