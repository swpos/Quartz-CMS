<?php
	if(preg_match('/\{(.*?)\}$/',$al_modules,$al_match2)) {
		if(preg_match('/comments\{(.*?)\}/',$al_match2[1],$al_match3)) {
			$al_options = explode(':',$al_match3[1]);
					
			if($al_options[0]=='show_title'){$al_show_title='yes';}else {$al_show_title='no';}
			if($al_options[1]=='show_description'){$al_show_description='yes';}else {$al_show_description='no';}
			if($al_options[2]=='show_username'){$al_show_username='yes';}else {$al_show_username='no';}
			if($al_options[3]=='show_time'){$al_show_time='yes';}else {$al_show_time='no';}
			if($al_options[4]=='show_date'){$al_show_date='yes';}else {$al_show_date='no';}
		}
	}
?>
<h2 class="comment-title">Comments</h2>
<?php
	while($al_fetch_comments = $select1->fetch()){
		$al_shortcut_full=decoding($al_fetch_comments->shortcut);
		$al_id=decoding($al_fetch_comments->id);
		if($al_show_title=='yes'){$al_title=decoding($al_fetch_comments->title);}
		if($al_show_description=='yes'){$al_content=decoding($al_fetch_comments->content);}
		if($al_show_date=='yes'){$al_date=decoding($al_fetch_comments->date);}
		if($al_show_time=='yes'){$al_time=decoding($al_fetch_comments->time);}
		$al_username=decoding($al_fetch_comments->username);
?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="well">
                        <ul>
                            <?php if($al_show_username=='yes'){ ?><li><?php echo $al_username ?></li><?php } ?>
                            <?php if($al_show_date=='yes'){ ?><li><?php echo $al_date ?></li><?php } ?>
                            <?php if($al_show_time=='yes'){ ?><li><?php echo $al_time ?></li><?php } ?>
                            <?php if(isset($_SESSION['pseudom'])){ ?><li><a href="index.php?action=delete_comment&id=<?php echo $al_id ?>">Delete</a></li><?php } ?>
                        </ul>
                    </div> 
                </div>    
                <div class="col-md-9">
                    <div class="well">
                        <?php if($al_show_title=='yes'){ ?><h3><?php echo $al_title ?></h3><?php } ?>
                        <?php if($al_show_description=='yes'){ ?><div id="content-item"><?php echo $al_content ?></div><?php } ?>
                    </div> 
                </div>
            </div>   
        </div>    
    </div>
<?php echo $_SESSION['error_message']; ?>
<?php 
	}	
	$_SESSION['error_message'] = '';
?>
<form action="index.php?action=post_comment" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" size="30" class="form-control" name="title" placeholder="* Title" />
            </div>
            <div class="form-group">    
                <input type="text" size="30" class="form-control" name="username" placeholder="* Username" />
            </div>
            <div class="form-group">    
                <input type="text" size="30" class="form-control" name="question" placeholder="* (6+100)/2" />
            </div>    
        </div>        
        <div class="col-md-6">
            <div class="form-group">     
                <textarea cols="30" rows="6" class="form-control" name="content" placeholder="* Comment"></textarea>
            </div>    
        </div> 
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" value="<?php echo $al_shortcut ?>" size="30" name="shortcut" />
            <input type="hidden" value="<?php echo $al_id_module ?>" size="30" name="id_module" />
            <div class="form-group"> 
                <button type="submit" class="btn btn-default" name="submit" />Send</button>
            </div>
        </div> 
    </div>
</form>