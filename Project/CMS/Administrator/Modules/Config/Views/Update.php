<?php echo $top_menu; ?>
<h1><?php echo CONFIGURATION_UPDATE ?></h1>
<?php echo $error; ?>
<?php include('../config.php'); ?>

<div class="row">
    <div class="col-md-12">
    	<?php if($repo_version != $cms_version) { ?>
        	<p><?php echo UPDATE_INTRO ?></p>
            <?php if(function_exists('exec')){ ?>
				<?php if (strpos(exec("git --version"), 'git version') !== false){ ?>
                    <div class="alert alert-success">
                        <p><?php echo UPDATE_GIT_INSTALLED.'<br />'.exec("git --version") ?></p>
                    </div>
                    <p><?php echo UPDATE_CMS ?></p>
                    <form action='index.php?page=Config&action=update_cms_post' method='post'  id="validator" role="form" />
                    <input type="submit" value="<?php echo BUTTON_UPDATE ?>" />
                    </form>
                    <div class="alert alert-warning">
                        <p><?php echo UPDATE_COMPOSER_WILL_BE_UPDATED.'<br />'.exec("php --version"); ?></p>
                    </div>
                    <?php if(!empty($extension)) { ?>
                    	<div class="alert alert-danger">
                            <p><?php echo UPDATE_COMPOSER_NEW_FILES ?></p>
                            <p><?php echo UPDATE_COMPOSER_NEW_FILES_DONT_EXIST ?></p>
                            <ul>
								<?php foreach($extension as $value) { ?>
                                    <li><?php echo $value; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
					<?php } ?>
                <?php } else { ?>
                    <div class="alert alert-danger">
                        <p><?php echo UPDATE_GIT_NOT_INSTALLED ?></p>
                    </div>
                    <div class="alert alert-warning">
                        <p><?php echo UPDATE_FILE_NEEDS_BE_COPIED ?></p>
                    </div>
                    <div class="alert alert-warning">
                        <p><?php echo UPDATE_COMPOSER_NEED_BE_UPDATED ?></p>
                    </div>
                <?php } ?>
            <?php } else { ?>
            	<div class="alert alert-warning">
                    <p><?php echo UPDATE_FUNCTION_EXEC_DONT_EXIST ?></p>
                </div>
                <div class="alert alert-warning">
                    <p><?php echo UPDATE_FILE_NEEDS_BE_COPIED ?></p>
                </div>
                <div class="alert alert-warning">
                    <p><?php echo UPDATE_COMPOSER_NEED_BE_UPDATED ?></p>
                </div>
            <?php } ?>
		<?php } else { ?>
            <div class="alert alert-success">
                <p><?php echo UPDATE_CMS_IS_UPTODATE ?></p>
            </div>
        <?php } ?>
    </div>
    <div class="col-md-12">
    	<h2><?php echo TEMPLATES_OVERRIDE_CHECKUP; ?></h2>
    	<?php
			$not_matched = 0;
			$html_dir = '../Templates/'.$system_template->loaddefaulttemplate().'/html';
			if(file_exists($html_dir)){
				$folders = scandir($html_dir);
				
				foreach ($folders as $al_key => $al_value) {
					if($al_value != '.' && $al_value != '..'){
						$folders2 = scandir($html_dir.'/'.$al_value);
						foreach ($folders2 as $al_key2 => $al_value2) {
							if($al_value2 != '.' && $al_value2 != '..'){
								if(file_get_contents($html_dir.'/'.$al_value.'/'.$al_value2) != file_get_contents('../Modules/'.$al_value.'/Views/'.$al_value2)){
									echo "<div class=\"text-danger\">";
									echo $html_dir.'/'.$al_value.'/'.$al_value2.' '. TEMPLATES_OVERRIDE_NOT_MATCHED . ' ../Modules/'.$al_value.'/Views/'.$al_value2;
									$not_matched = 1;
									echo "</div>";
								} else {
									echo "<div class=\"text-success\">";
									echo $html_dir.'/'.$al_value.'/'.$al_value2.' '. TEMPLATES_OVERRIDE_MATCHED . ' ../Modules/'.$al_value.'/Views/'.$al_value2;
									echo "</div>";
								}
							}
						}
					}
				}
			}
			if($not_matched == 0){
			?>
            	<div class="alert alert-success">
					<?php echo TEMPLATES_OVERRIDE_ALL_MATCHED; ?>
				</div>              
			<?php
            } else {
			?>	
            	<div class="alert alert-danger">
					<?php echo TEMPLATES_OVERRIDE_NOT_MATCHED_ALL; ?>
                </div> 
            <?php    
			}
		?>
    </div>
</div>
</form>