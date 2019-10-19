<?php echo $top_menu; ?>
<h1><?php echo SHOW_MEDIAS ?></h1>
<?php echo $error; ?>
<form action="index.php?page=Media&action=process_media" method="post">
    <div class="row">
        <div class="col-md-2">
        	<div class="well">
                <table class="table-info table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>
                                <?php echo MEDIA_LIST ?>
                            </th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><?php echo MEDIA_LIST ?></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
						$folders = scandir($folder);
						foreach ($folders as $al_key => $al_value) {
							if($al_value != '.'){
								if ($al_value == '..') {
									$folder_parent = $folder;
									$folder_parent = explode('/', $folder_parent);
									$new_path = array_pop($folder_parent);
									$folder_parent = implode('/', $folder_parent);
									if($folder_parent != '..'){
									?>	
									<tr>
										<td>
                                            <a href="index.php?page=Media&action=media_show&folder=<?php echo $folder_parent; ?>" style="color: #ffffff; padding: 0px;" class="btn btn-primary">
                                                <span class="glyphicon glyphicon-arrow-left"></span>
                                            </a>
										</td>
									</tr>
							<?php 
									}
								} else {
							?>
                            	<?php if (is_dir($folder.'/'.$al_value)){ ?>
									<tr>
										<td>
											<label class="label label-warning">
                                                <a href="index.php?page=Media&action=media_show&folder=<?php echo $folder; ?>/<?php echo $al_value; ?>" style="color: #ffffff;">
                                                    <?php 
                                                        echo $al_value;
                                                    ?>
                                                </a>
                                            </label>
										</td>
									</tr>	
									<?php }
								}
							}
                        }
                        ?>
                	</tbody>
                </table>
        	</div>
        </div>
        <div class="col-md-10">
        	<div class="text-success" style="display:inline-block;">
            	<p><?php echo $folder; ?></p>
            </div>
            <table class="table-info table-striped list">
                <thead>
                    <tr>
                        <th><?php echo SHOW_MEDIAS_PICTURE ?></th>
                        <th><?php echo SHOW_MEDIAS_FILE_NAME ?></th>
                        <th><?php echo SHOW_MEDIAS_FILE_SIZE ?> | <?php echo SHOW_MEDIAS_MIME_TYPE ?></th>
                        <th><?php echo SHOW_MEDIAS_MOVE_FOLDER ?></th>
                        <th><?php echo SHOW_MEDIAS_COPY_FILE ?></th>
                        <th><?php echo SHOW_MEDIAS_DELETE ?></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><?php echo SHOW_MEDIAS_PICTURE ?></th>
                        <th><?php echo SHOW_MEDIAS_FILE_NAME ?></th>
                        <th><?php echo SHOW_MEDIAS_FILE_SIZE ?> | <?php echo SHOW_MEDIAS_MIME_TYPE ?></th>
                        <th><?php echo SHOW_MEDIAS_MOVE_FOLDER ?></th>
                        <th><?php echo SHOW_MEDIAS_COPY_FILE ?></th>
                        <th><?php echo SHOW_MEDIAS_DELETE ?></th>
                    </tr>
                </tfoot>
                <tbody>
                <?php
                foreach ($folders as $al_key => $al_value) {
                    if (($al_value != '..') && ($al_value != '.') && (!is_dir($folder .'/'. $al_value))) {
                        ?>
                        <tr>
                            <td><a href="<?php echo $folder ?>/<?php echo $al_value; ?>" target="_blank"><img src="<?php echo $folder ?>/<?php echo $al_value; ?>" width="50" height="50" /></a></td>
                            <td><?php echo $al_value; ?></td>
                            <td><?php echo filesize($folder .'/'. $al_value); ?> <?php echo SHOW_MEDIAS_BYTES ?> | <?php echo mime_content_type($folder .'/'. $al_value); ?></td>
                            <td>
                            	<input type="hidden" value="<?php echo $folder ?>/<?php echo $al_value; ?>" name="old_path[]" />
                                <select name="new_folder[]">
                                <option value="">
                                    <?php echo SHOW_MEDIAS_MOVE_FOLDER ?>
                                </option>
                                <?php
                                    $folder_parent = $folder;
                                    $folder_parent = explode('/', $folder_parent);
                                    $new_path = array_pop($folder_parent);
                                    $folder_parent = implode('/', $folder_parent);
									if($folder_parent != '..'){
                                ?>
                                <option value="<?php echo $folder_parent ?>/<?php echo $al_value; ?>">
                                    <?php echo $folder_parent ?>/<?php echo $al_value; ?>
                                </option>
                                <?php 
									}
                                    foreach ($folders as $al_key => $al_value2) {
										if(($al_value2 != '..') && ($al_value2 != '.') && (is_dir($folder .'/'. $al_value2))){
                                        ?>
                                            <option value="<?php echo $folder ?>/<?php echo $al_value2; ?>/<?php echo $al_value; ?>">
                                                <?php echo $folder ?>/<?php echo $al_value2; ?>/<?php echo $al_value; ?>
                                            </option>
                                        <?php
										}
                                    }
                                ?>
                                </select>
                            </td>
                            <td><input type="checkbox" name="copy[]" value="1"> <?php echo SHOW_MEDIAS_COPY_FILE ?></td>
                            <td><input type="checkbox" name="images[]" value="<?php echo $folder ?>/<?php echo $al_value; ?>"> <?php echo SHOW_MEDIAS_DELETE ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
            <input type="submit" class="btn btn-primary" value="<?php echo BUTTON_UPDATE ?>" />
        </div>
    </div>
</form>