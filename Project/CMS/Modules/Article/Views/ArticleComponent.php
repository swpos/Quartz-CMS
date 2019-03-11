<?php
	$al_show_title = "";
	$al_show_description = "";
	$al_show_username = "";
	$al_show_time = "";
	$al_show_date = "";

	$al_options = $params['article'];
	$al_show_title = !empty($al_options['show_title']) ? true : false;
	$al_show_description = !empty($al_options['show_description']) ? true : false;
	$al_show_username = !empty($al_options['show_username']) ? true : false;
	$al_show_time = !empty($al_options['show_time']) ? true : false;
	$al_show_date = !empty($al_options['show_date']) ? true : false;
?>
    <?php if ($al_show_title): ?>
        <h2><?php echo $articles->title ?></h2>
    <?php
    endif;
    if ($al_show_username || $al_show_date || $al_show_time):
    ?>
        <ul>
            <?php if ($al_show_username): ?>
                <li><?php echo $articles->username ?></li>
            <?php endif; ?>
            <?php if ($al_show_date): ?>
                <li><?php echo $articles->date ?></li>
            <?php endif; ?>
            <?php if ($al_show_time): ?>
                <li><?php echo $articles->time ?></li>
            <?php endif; ?> 
        </ul>
    <?php
    endif;

    if ($al_show_description):
    ?>
        <?php echo $articles->content ?>
    <?php
    endif;
    ?>