<?php
$al_options = $params['gallery'];
$al_show_title = !empty($al_options['show_title']) ? true : false;
$al_show_description = !empty($al_options['show_description']) ? true : false;
$al_show_time = !empty($al_options['show_time']) ? true : false;
$al_show_date = !empty($al_options['show_date']) ? true : false;
?>

<div class="row">
<div class="col-md-12">
<?php if ($al_show_title): ?>
    <h3><?php echo $modules->title ?></h3>
<?php endif; ?>
<?php if ($al_show_date || $al_show_time): ?>
    <ul>
        <?php if ($al_show_date): ?>
            <li><?php echo $modules->date ?></li>
        <?php endif; ?>
        <?php if ($al_show_time == 'yes'): ?>
            <li><?php echo $modules->time ?></li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php if ($al_show_description): ?>
            <div class="row">
                <?php
                $al_dir = 'Media/gallery';
                $al_get_folders = scandir($al_dir);
        
                foreach ($al_get_folders as $al_key => $al_value):
                    $get_id = explode('_', $al_value);
                    if ($get_id[0] == $id): ?>
                        <div class="col-md-3">		
                            <p>
                                <a href="Media/gallery/<?php echo $al_value ?>" title="<?php echo $get_id[1] ?>" class="gallery-<?php echo $id; ?>">
                                    <img src="Media/gallery/<?php echo $al_value ?>" alt="<?php echo $get_id[1] ?>" width="100%" height="auto" />
                                </a>
                            </p>
                        </div>    
                <?php
                    endif;
                endforeach;
                ?>
            </div>
		<?php endif; ?>
	</div>
</div>
<script type="text/javascript">
	$('a.gallery-<?php echo $id; ?>').popup('image');
</script>