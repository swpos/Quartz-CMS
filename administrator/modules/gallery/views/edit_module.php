<?php
	$al_id=decoding($al_fetch_modules->id);
	$al_category=decoding($al_fetch_modules->category);
	$al_title=decoding($al_fetch_modules->title);
	$al_modules=decoding($al_fetch_modules->modules);
	$al_position_module=decoding($al_fetch_modules->position);
	$al_date=decoding($al_fetch_modules->date);
	$al_time=decoding($al_fetch_modules->time);
	$al_shortcut_multiple=decoding(explode(':',$al_fetch_modules->shortcut));
	$al_shortcut_multiple2=decoding($al_fetch_modules->shortcut);
?>
<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>EDIT GALLERY MODULE</h1>
<form action="index.php?page=gallery&action=post&id=<?php echo $al_id; ?>" method="post" id="validator" role="form">
    <div class="row">
        <div class="col-md-6">
            <input name="category" type="hidden" size="30" value="<?php echo $al_category; ?>" />
            <table class="table-striped">
                <tr>
                    <td width="20%">Title</td>
                    <td><input name="title" type="text" class="form-control" size="30" value="<?php echo $al_title; ?>" /></td>
                </tr>
                <tr>
                    <td width="20%">Type of module</td>
                    <td>Gallery</td>
                </tr>		
                <tr>
                    <td width="20%">Date created</td>
                    <td><?php echo $al_date; ?></td>
                </tr>		
                <tr>
                    <td width="20%">Hour created</td>
                    <td><?php echo $al_time; ?></td>
                </tr>
                <tr>
                    <td width="20%">Position</td>
                    <td>
                        <?php echo modify_position($al_connexion, $al_position_module); ?>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Pages affected</td>
                    <td>
                        <?php echo modify_shortcut($al_connexion, $al_shortcut_multiple); ?>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Id of the module</td>
                    <td><?php echo $al_id_module ?></td>
                </tr>
			</table>
		</div>
		<div class="col-md-6">
			<table class="table-striped">
		<?php 
				if(preg_match('/\{(.*?)\}$/', $al_modules, $al_match)) { 
					if(preg_match('/\{(.*?)\}$/',$al_match[1],$al_match2)) {
		?>
				<tr>
                	<td width="20%">Options</td>
                    <td></td>
                </tr>
		<?php	
				if(preg_match('/gallery\{(.*?)\}/',$al_match2[1],$al_match3)) {	
					$al_options2 = explode(':',$al_match3[1]);
		?>
            	<tr>
                	<td width="20%">Show title</td>
                    <td>
                        <select class="chosen-select form-control" name="show_title">
                            <option value="show_title" <?php if($al_options2[0] == 'show_title'){ ?>selected="selected"<?php } ?>>Show</option>
                            <option value="0" <?php if($al_options2[0] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                        </select>
					</td>
				</tr>
                <tr>
                	<td width="20%">Show description</td>
                    <td>
                        <select class="chosen-select form-control" name="show_description">
                            <option value="show_description" <?php if($al_options2[1] == 'show_description'){ ?>selected="selected"<?php } ?>>Show</option>
                            <option value="0" <?php if($al_options2[1] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                        </select>
					</td>
				</tr>
                <tr>
                	<td width="20%">Show time</td>
                    <td>
                        <select class="chosen-select form-control" name="show_time">
                            <option value="show_time" <?php if($al_options2[2] == 'show_time'){ ?>selected="selected"<?php } ?>>Show</option>
                            <option value="0" <?php if($al_options2[2] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                        </select>
					</td>
				</tr>
                <tr>
                	<td width="20%">Show Date</td>
                    <td>
                        <select class="chosen-select form-control" name="show_date">
                            <option value="show_date" <?php if($al_options2[3] == 'show_date'){ ?>selected="selected"<?php } ?>>Show</option>
                            <option value="0" <?php if($al_options2[3] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                        </select>
					</td>
				</tr>
		<?php
                }
            }
        }
        ?>
			</table>
			<input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
			<input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
			<input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
			<input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
			<input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
			<input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" />
			<div style="clear:right; display:block; ">
				<?php
                $al_dir    = '../media/gallery';
                $al_get_folders = scandir($al_dir);
                
                foreach($al_get_folders as $al_key => $al_value){
                    $get_id = explode('_',$al_value);
                    
                    if($get_id[0] == $al_id_module){
				?>
                        <img src="../media/gallery/<?php echo $al_value ?>" width="150" style="margin:5px; float:left;" height="auto" />
                <?php
				    }
                }
                ?>
			</div>
		</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="submit" class="btn btn-primary" name="post" value="Modify" />
        </div>
    </div>
</form>