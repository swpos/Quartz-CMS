<?php
	$al_show_title_category = "";
	$al_show_title = "";
	$al_show_description = "";
	$al_show_username = "";
	$al_show_time = "";
	$al_show_date = "";
	
	$al_options = $params['category'];
	$al_show_title_category = !empty($al_options['show_title']) ? true : false;

	$al_options = $params['article'];
	$al_show_title = !empty($al_options['show_title']) ? true : false;
	$al_show_description = !empty($al_options['show_description']) ? true : false;
	$al_show_username = !empty($al_options['show_username']) ? true : false;
	$al_show_time = !empty($al_options['show_time']) ? true : false;
	$al_show_date = !empty($al_options['show_date']) ? true : false;

	if ($al_show_title_category):
    ?>
    	<h1><?php echo $title ?></h1><br />
    <?php
	endif;

	foreach ($v->d_a($articles) as $article):
    	if ($al_show_title):
    ?>
        <h2><?php echo $articles->title ?></h2>
    <?php
    endif;
    if ($al_show_username || $al_show_date || $al_show_time):
    ?>
        <ul>
            <?php if ($al_show_username): ?>
                <li><?php echo $article->username ?></li>
            <?php endif; ?>
            <?php if ($al_show_date): ?>
                <li><?php echo $article->date ?></li>
            <?php endif; ?>
            <?php if ($al_show_time): ?>
                <li><?php echo $article->time ?></li>
        	<?php endif; ?> 
        </ul>
    <?php
    endif;
    if ($al_show_description):
    ?>
        <div id='content-item'><?php echo $article->content ?></div>
   	<?php
    endif;
	endforeach;
?>	