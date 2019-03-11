<?php
	if(preg_match('/\{(.*?)\}$/',$al_modules,$al_match2)) {
		if(preg_match('/category\{(.*?)\}/',$al_match2[1],$al_match3)) {
			$al_options = explode(':',$al_match3[1]);
			
			if($al_options[0]=='show_title'){ $al_show_title_category='yes'; }else {$al_show_title_category='no';}
		}
		
		if(preg_match('/article\{(.*?)\}/',$al_match2[1],$al_match3)) {
			$al_options = explode(':',$al_match3[1]);		
			
			if($al_options[0]=='show_title'){$al_show_title='yes';}else{$al_show_title='no';}
			if($al_options[1]=='show_description'){$al_show_description='yes';}else{$al_show_description='no';}
			if($al_options[2]=='show_username'){$al_show_username='yes';}else{$al_show_username='no';}
			if($al_options[3]=='show_time'){$al_show_time='yes';}else{$al_show_time='no';}
			if($al_options[4]=='show_date'){$al_show_date='yes';}else{$al_show_date='no';}
		}
	}
?>		
<?php if($al_show_title_category=='yes'){ ?>
	<h1><?php echo $al_title_module ?></h1>
    <br />
<?php } ?>
<?php 
	while($al_fetch_articles = $select1->fetch()){
		$al_shortcut_full=decoding($al_fetch_articles->shortcut);
		$al_title=decoding($al_fetch_articles->title);
		$al_content=decoding_ck($al_fetch_articles->content);
		$al_date=decoding($al_fetch_articles->date);
		$al_time=decoding($al_fetch_articles->time);
		$al_username=decoding($al_fetch_articles->username);
?>	
	<?php if($al_show_title=='yes'){ ?>
    	<h2><?php echo $al_title ?></h2>
	<?php } ?>
	
	<?php if($al_show_username=='yes' || $al_show_date=='yes' || $al_show_time=='yes'){ ?>
        <ul>
            <?php if($al_show_username=='yes'){ ?> 
            	<li><?php echo $al_username ?></li>
			<?php } ?>
            <?php if($al_show_date=='yes'){ ?> 
            	<li><?php echo $al_date ?></li>
			<?php } ?>
            <?php if($al_show_time=='yes'){ ?> 
            	<li><?php echo $al_time ?></li>
			<?php } ?>
        </ul>
	<?php } ?>
	<?php if($al_show_description=='yes'){ echo $al_content; } ?>
<?php 
	} 
?>