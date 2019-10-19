<?php echo $top_menu; ?>
<h1><?php echo EDIT_TEMPLATE ?></h1>
<?php echo $error; ?>
<form action='index.php?page=Template&action=template_edit_post&alias=<?php echo $alias; ?>&file=<?php echo $file; ?>&folder=<?php echo $folder; ?>' method='post' />
    <div class="row">
        <div class="col-md-2">
        	<div class="well">
                <table class="table-info table-striped">
                    <thead>
                        <tr>
                            <th>
                                <p><a href="index.php?page=Template&action=template_edit&alias=<?php echo $alias; ?>&folder=../Templates/<?php echo $alias; ?>&file="><img src='../Templates/<?php echo $alias; ?>/preview.jpg' style='width:100%; height:auto;' /></a></p>
                                <?php echo FOLDER_LIST ?>
                            </th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><?php echo FOLDER_LIST ?></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
						$folders = scandir($folder);
						$folders_sorted = array();
						$files_sorted = array();
						foreach ($folders as $al_key => $al_value) {
							if(is_dir($folder.'/'.$al_value)){
								$folders_sorted[] = $al_value;
							} else {
								$files_sorted[] = $al_value;
							}
						}
						$folders = array_merge($folders_sorted, $files_sorted);
						foreach ($folders as $al_key => $al_value) {
							if($al_value != '.'){
								if ($al_value == '..') {
									$folder_parent = $folder;
									$folder_parent = explode('/', $folder_parent);
									$new_path = array_pop($folder_parent);
									$folder_parent = implode('/', $folder_parent);
									if($folder_parent != '../Templates'){
									?>	
									<tr>
										<td>
                                            <a href="index.php?page=Template&action=template_edit&alias=<?php echo $alias; ?>&folder=<?php echo $folder_parent; ?>&file=" style="color: #ffffff; padding: 0px;" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-arrow-left"></span>
                                            </a>
										</td>
									</tr>
							<?php 
									}
								} else {
							?>
									<tr>
										<td>
											<?php if (!is_dir($folder.'/'.$al_value)){ ?>
												<label class="label label-success">
													<a href="index.php?page=Template&action=template_edit&alias=<?php echo $alias; ?>&folder=<?php echo $folder; ?>&file=<?php echo $al_value; ?>" style="color: #ffffff;">
														<?php 
															echo $al_value;
														?>
													</a>
												</label>
											<?php } else { ?>
												<label class="label label-warning">
													<a href="index.php?page=Template&action=template_edit&alias=<?php echo $alias; ?>&folder=<?php echo $folder; ?>/<?php echo $al_value; ?>&file=" style="color: #ffffff;">
														<?php 
															echo $al_value;
														?>
													</a>
												</label>
											<?php } ?>
										</td>
									</tr>	
									<?php
								}
							}
                        }
                        ?>
                        <tr>
                        	<td>
                            	<?php echo ADD_FILE ?><br />
                                <input type="hidden" value="<?php echo $folder ?>" name="location" />
                            	<input type="text" value="" name="namefile" />
                            </td>
                        </tr>
                    </tbody>
                </table>
        	</div>
        </div>
        <div class="col-md-10">
        	<p class="pull-right"><?php echo DELETE_FILE ?>: <input type="checkbox" name="delete" value="1" <?php if(is_dir($folder.'/'.$file) || !file_exists($folder.'/'.$file)){ echo "disabled=\"disabled\""; } ?> /></p>
        	<?php if (file_exists($folder.'/'.$file) && !is_dir($folder.'/'.$file)) { ?>
                <div class="text-success" style="display:inline-block;"><input type="hidden" value="<?php echo $folder; ?>/<?php echo $file; ?>" name="path" />
                <input type="hidden" value="<?php echo $folder; ?>" name="folder" />
                <?php echo $folder; ?>/ <input type="text" value="<?php echo $file; ?>" name="rename" style="display:inline-block; width: auto;" /></div>
            <?php } else { ?>
            	<div class="text-success" style="display:inline-block;"><input type="hidden" value="<?php echo $folder; ?>" name="path" />
                <?php
                $dirs = explode('/', $folder);
				$file = end($dirs);
				$new_path = array_pop($dirs);
				$folder = implode('/', $dirs);
				?>
                <input type="hidden" value="<?php echo $folder; ?>" name="folder" />
                <?php echo $folder; ?>/ <input type="text" value="<?php echo $file; ?>" <?php if($folder == '../Templates'){ echo "disabled=\"disabled\""; } ?> name="rename" style="display:inline-block; width: auto;" /></div>
           	<?php } ?>
            <div class="well">
            	<textarea name="content" style="height: 500px;" <?php if (is_dir($folder.'/'.$file) || $fichier_mime == '1'){ echo "disabled=\"disabled\""; } ?>><?php if (is_dir($folder.'/'.$file) || $fichier_mime == '1'){ echo FILE_FORBIDDEN; } else { echo $source; } ?></textarea>
            </div>
            <input type='submit' value='<?php echo BUTTON_UPDATE ?>' />
        </div>
    </div>
</form>