<?php
	$al_id=decoding($al_fetch_modules->id);
	include('../templates/'.loaddefaulttemplate($al_connexion).'/information.php');
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
<h1>EDIT COMMENT MODULE</h1>
<form action="index.php?page=comment&action=post&id=<?php echo $al_id; ?>" method="post" id="validator" role="form">
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
                    <td>Comments</td>
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
                        <select class="chosen-select form-control" name="position">
                            <?php
                                foreach ($al_position as $al_values){	
                                    if($al_values == $al_position_module){
                            ?>
                                    <option value="<?php echo $al_values; ?>" selected="selected"><?php echo $al_values; ?></option>
                            <?php
                                    } else {
                            ?>
                                    <option value="<?php echo $al_values; ?>"><?php echo $al_values; ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Pages affected</td>
                    <td>
                        <ul>
                            <li><input type="checkbox" id="select_all"/> Check all/Uncheck all</li>
                            <?php
                                $select2=$al_connexion->query("SELECT * FROM ".HASH."_section_name");
                                $select2->setFetchMode(PDO::FETCH_OBJ);
                                while($al_fetch_section_name = $select2->fetch()){ 
                                    $al_id=decoding($al_fetch_section_name->id);
                                    $al_section=decoding($al_fetch_section_name->section);
                            ?>		
                                    <li style="float:left; margin:20px;"><?php echo $al_section; ?>
                                        <ul style="padding:0px; margin:0px; list-style-type:none;">
                            <?php		
                                    $select3=$al_connexion->query("SELECT * FROM ".HASH."_link_menu WHERE id_index='".$al_id."'");
                                    $select3->setFetchMode(PDO::FETCH_OBJ);
                        
                                    while($al_fetch_link_menu = $select3->fetch()){
                                        $al_name=decoding($al_fetch_link_menu->name);
                                        $al_shortcut_unique=decoding($al_fetch_link_menu->shortcut);
                                        
                                        if(in_array($al_shortcut_unique, $al_shortcut_multiple)){
                            ?>				
                                            <li><input type="checkbox" name="shortcut[]" value="<?php echo $al_shortcut_unique; ?>" checked="checked"> <?php echo $al_name; ?></li>
                            <?php
                                        } else {
                            ?>
                                            <li><input type="checkbox" name="shortcut[]" value="<?php echo $al_shortcut_unique; ?>" > <?php echo $al_name; ?></li>
                            <?php
                                        }	
                                    }
                            ?>
                                        </ul>
                                    </li>
                            <?php       	
                                }
                            ?>
                        </ul>
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
				if(preg_match('/comments\{(.*?)\}/',$al_match2[1],$al_match3)) {	
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
                	<td width="20%">Show username</td>
                    <td>
                        <select class="chosen-select form-control" name="show_username">
                            <option value="show_username" <?php if($al_options2[2] == 'show_username'){ ?>selected="selected"<?php } ?>>Show</option>
                            <option value="0" <?php if($al_options2[2] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                        </select>
					</td>
				</tr>
                <tr>
                	<td width="20%">Show time</td>
                    <td>
                        <select class="chosen-select form-control" name="show_time">
                            <option value="show_time" <?php if($al_options2[3] == 'show_time'){ ?>selected="selected"<?php } ?>>Show</option>
                            <option value="0" <?php if($al_options2[3] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                        </select>
					</td>
				</tr>
                <tr>
                	<td width="20%">Show Date</td>
                    <td>
                        <select class="chosen-select form-control" name="show_date">
                            <option value="show_date" <?php if($al_options2[4] == 'show_date'){ ?>selected="selected"<?php } ?>>Show</option>
                            <option value="0" <?php if($al_options2[4] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                        </select>
					</td>
				</tr>
		<?php
                }
            }
        }
        ?>
			</table>
		</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="submit" class="btn btn-default" name="post" value="Modify" />
        </div>
    </div>
</form>