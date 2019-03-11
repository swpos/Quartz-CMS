<?php
	$al_show_title = "";
	$al_show_description = "";
	$al_show_time = "";
	$al_show_date = "";
	
	$al_options = $params['article'];
	$al_show_title = !empty($al_options['show_title']) ? true : false;
	$al_show_description = !empty($al_options['show_description']) ? true : false;
	$al_show_time = !empty($al_options['show_time']) ? true : false;
	$al_show_date = !empty($al_options['show_date']) ? true : false;
	
	if ($al_show_title):
	?>
		<h2><?php echo $al_fetch_modules->title ?></h2>
	<?php
	endif;
	if ($al_show_date || $al_show_time):
	?>
		<ul>
			<?php if ($al_show_date): ?>
				<li><?php echo $al_fetch_modules->date ?></li>
			<?php endif; ?>
			<?php if ($al_show_time): ?>
				<li><?php echo $al_fetch_modules->time ?></li>
			<?php endif; ?> 
		</ul>
	<?php
	endif;
	if ($al_show_description):
		$_SESSION['lang'] = isset($_SESSION['lang']) ? $_SESSION['lang'] : "en";
		if($_SESSION['lang']=="en"):
			$language = "fr";
			$language_name = "Français"; 
		else:
			$language = "en";
			$language_name = "English";
		endif;
	?>
		<ul class="nav navbar-nav">
			<li>
				<a href="/Language/changelang/<?php echo $language ?>"><?php echo $language_name ?></a>
			</li>
		</ul>
	<?php
	endif;
?>
