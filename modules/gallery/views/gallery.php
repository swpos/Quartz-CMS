<?php
	if(preg_match('/\{(.*?)\}$/',$al_modules,$al_match2)) {
		if(preg_match('/gallery\{(.*?)\}/',$al_match2[1],$al_match3)) {
			$al_options = explode(':',$al_match3[1]);
			if($al_options[0]=='show_title'){$al_show_title='yes';}else{$al_show_title='no';}
			if($al_options[1]=='show_description'){$al_show_description='yes';}else{$al_show_description='no';}
			if($al_options[2]=='show_time'){$al_show_time='yes';}else{$al_show_time='no';}
			if($al_options[3]=='show_date'){$al_show_date='yes';}else{$al_show_date='no';}
		}
	}
	$id = $al_id_module;
?>
<div class="row">
    <div class="col-md-12">
		<?php if($al_show_title=='yes'){ ?><h2><?php echo $al_fetch_modules->title ?></h2><?php } ?>
		<?php if($al_show_date=='yes' || $al_show_time=='yes') { ?>
			<ul>
				<?php if($al_show_date=='yes'){ ?><li><?php echo decoding($al_fetch_modules->date) ?></li><?php } ?>
                <?php if($al_show_time=='yes'){ ?><li><?php echo decoding($al_fetch_modules->time) ?></li><?php } ?>
			</ul>
		<?php } ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
		<?php if($al_show_description=='yes'){ ?>
            <div class="row">
				<?php 
                    $al_dir    = 'media/gallery';
                    $al_get_folders = scandir($al_dir);
                    foreach($al_get_folders as $al_key => $al_value){
                        $get_id = explode('_',$al_value);
                        if($get_id[0]==$id){
                ?>
                        <div class="col-md-3">		
                            <p>
                                <a href="media/gallery/<?php echo $al_value ?>" title="<?php echo $get_id[1] ?>" class="gallery-<?php echo $id ?>">
                                    <img src="media/gallery/<?php echo $al_value ?>" alt="<?php echo $get_id[1] ?>" width="100%" height="auto" />
                                </a>
                            </p>
                        </div>
                <?php
                        }
                    }
                ?>
			</div>		
		<?php } ?>
    </div>
</div>
<script type="text/javascript" src="plugins/gallery/popup.js"></script>
<script type="text/javascript">					
    $('a.gallery-<?php echo $id ?>').popup('image');
</script>