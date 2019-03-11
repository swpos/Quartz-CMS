<div class="row">
	<div class="col-md-12">
		<h2 class="comment-title"><?php echo COMMENT_MODULE_TITLE ?></h2>
		<?php
        
		$al_options = $params['article'];
		$al_show_title = !empty($al_options['show_title']) ? true : false;
		$al_show_description = !empty($al_options['show_description']) ? true : false;
		$al_show_username = !empty($al_options['show_username']) ? true : false;
		$al_show_email = !empty($al_options['show_email']) ? true : false;
		$al_show_time = !empty($al_options['show_time']) ? true : false;
		$al_show_date = !empty($al_options['show_date']) ? true : false;
		
        foreach ($v->d_a($comments) as $comment): ?>
            <div class="row">
                <div class="col-md-12">
                	<div class="row">
                		<div class="col-md-3">
                        	<div class="well">
                                <?php if ($al_show_username || $al_show_date || $al_show_time || $al_show_email): ?>
                                    <ul>
                                        <?php if ($al_show_username): ?>
                                            <li><?php echo $comment->username ?></li>
                                        <?php endif; ?>
                                        <?php if ($al_show_date): ?>
                                            <li><?php echo $comment->date ?></li>
                                        <?php endif; ?>
                                        <?php if ($al_show_time): ?>
                                            <li><?php echo $comment->time ?></li>
                                        <?php endif ?> 
										<?php if ($al_show_email): ?>
                                            <li><?php echo $comment->email ?></li>
                                        <?php endif ?> 
                                        <?php if (!empty($_SESSION['pseudom'])): ?>
                                            <li><a href='/Comment/delete_comment/<?php echo $comment->id ?>'><?php echo COMMENT_MODULE_DELETE ?></a></li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                        	</div> 
                        </div>    
                    	<div class="col-md-9">
                        	<div class="well"> 
                            	<?php if ($al_show_title): ?>
                                    <h3><?php echo $comment->title ?></h3>
                                <?php endif; ?>   
								<?php if ($al_show_description): ?>
                                    <div id='content-item'><?php echo $comment->content ?></div>
                                <?php endif; ?>
                        	</div> 
                        </div>
                    </div>   
                </div>    
            </div>
		<?php endforeach; ?>
    </div>    
</div>
<form action="/Comment/post_comment" method="post">
	<div class="row">
        <div class="col-md-6">
			<div class="form-group">
            	<input type="text" size="30" class="form-control" name="comment[title]" placeholder="* <?php echo COMMENT_MODULE_FORM_TITLE ?>" required />
            </div>
            <div class="form-group">    
                <input type="text" size="30" class="form-control" name="comment[username]" placeholder="* <?php echo COMMENT_MODULE_FORM_USER ?>" required />
            </div>
			<div class="form-group">    
                <input type="text" size="30" class="form-control" name="comment[email]" placeholder="* <?php echo COMMENT_MODULE_FORM_EMAIL ?>" required />
            </div>
            <div class="form-group">    
               	<input type="text" size="30" class="form-control" name="question" placeholder="* (6+100)/2" required />
            </div>    
        </div>        
        <div class="col-md-6">
			<div class="form-group">     
            	<textarea cols="30" rows="6" class="form-control" id="comment<?php echo $id ?>" name="comment[content]" placeholder="* <?php echo COMMENT_MODULE_FORM_COMMENT ?>" required></textarea>
            </div>    
        </div> 
	</div>
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" value="<?php echo $page ?>" size="30" name="comment[shortcut]" />
            <input type="hidden" value="<?php echo $id ?>" size="30" name="comment[id_module]" />
            <div class="form-group"> 
            	<button type="submit" class="btn btn-default" name="submit" /><?php echo BUTTON_SEND ?></button>
            </div>
        </div> 
	</div>
</form>