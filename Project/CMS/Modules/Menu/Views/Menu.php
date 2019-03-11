<?php
$al_options = $params['category'];
$al_show_title = !empty($al_options['show_title']) ? true : false;

$menu_info = $system_skeleton->menu_params($id);
$al_id_menu = $menu_info['id'];

if ($al_show_title == true):
	echo $menu_info['section'];
endif;
?>

<ul class="nav navbar-nav">
	<?php
	$page = isset($_GET['page']) ? $_GET['page'] : 'index';
	
	$menu_item_info = $system_skeleton->menu_item_params($menu_info['id']);
	foreach ($menu_item_info as $key => $value):
	if($value['register'] == 1 && empty($_SESSION['pseudom'])){ continue; } 
	?>
		<li class="<?php if($page == $value['shortcut']){ echo "active"; } if($value['sub_menu']!=0){ echo "dropdown"; } ?>">
			<a href="<?php if($value['sub_menu']!=0){ echo "#"; }else{ echo $value['shortcut']; } ?>" 
				<?php if($value['sub_menu']!=0){ ?> 
					class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"
				<?php } ?>>
				<?php echo $value['name'] ?> 
				<?php if($page == $value['shortcut']){ ?><span class="sr-only">(current)</span><?php } ?>
				<?php if($value['sub_menu']!=0){ ?><span class="caret"></span><?php } ?>
			</a>
			<?php 
			if($value['sub_menu']!=0):
				echo $system_skeleton->create_menu_structure($value['sub_menu']); 
			endif;
			?>
		</li>
	<?php endforeach; ?>	
</ul>
