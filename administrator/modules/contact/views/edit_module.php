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
<h1>EDIT CONTACT MODULE</h1>
<form action="index.php?page=contact&action=post&id=<?php echo $al_id; ?>" method="post" id="validator" role="form">
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
                    <td>Contact</td>
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
				if(preg_match('/contacts\{(.*?)\}/',$al_match2[1],$al_match3)) {	
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
                        <td width="20%">Show First name</td>
                        <td>
                            <select class="chosen-select form-control" name="show_first_name">
                                <option value="show_first_name" <?php if($al_options2[1] == 'show_first_name'){ ?>selected="selected"<?php } ?>>Show</option>
                                <option value="0" <?php if($al_options2[1] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                            </select>
                        </td>
					</tr>
					<tr>
                        <td width="20%">Show Last name</td>
                        <td>
                            <select class="chosen-select form-control" name="show_last_name">
                                <option value="show_last_name" <?php if($al_options2[2] == 'show_last_name'){ ?>selected="selected"<?php } ?>>Show</option>
                                <option value="0" <?php if($al_options2[2] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                            </select>
						</td>
					</tr>
					<tr>
                        <td width="20%">Show Email</td>
                        <td>
                            <select class="chosen-select form-control" name="show_email">
                                <option value="show_email" <?php if($al_options2[3] == 'show_email'){ ?>selected="selected"<?php } ?>>Show</option>
                                <option value="0" <?php if($al_options2[3] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                            </select>
                        </td>
					</tr>
					<tr>
                        <td width="20%">Show Phone</td>
                        <td>
                            <select class="chosen-select form-control" name="show_phone">
                                <option value="show_phone" <?php if($al_options2[4] == 'show_phone'){ ?>selected="selected"<?php } ?>>Show</option>
                                <option value="0" <?php if($al_options2[4] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                            </select>
                        </td>
					</tr>
					<tr>
                        <td width="20%">Show Postal code</td>
                        <td>
                            <select class="chosen-select form-control" name="show_postal_code">
                                <option value="show_postal_code" <?php if($al_options2[5] == 'show_postal_code'){ ?>selected="selected"<?php } ?>>Show</option>
                                <option value="0" <?php if($al_options2[5] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                            </select>
                        </td>
					</tr>
					<tr>
                        <td width="20%">Show City</td>
                        <td>
                            <select class="chosen-select form-control" name="show_city">
                                <option value="show_city" <?php if($al_options2[6] == 'show_city'){ ?>selected="selected"<?php } ?>>Show</option>
                                <option value="0" <?php if($al_options2[6] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                            </select>
                        </td>
					</tr>
					<tr>
                        <td width="20%">Show State</td>
                        <td>
                            <select class="chosen-select form-control" name="show_state">
                                <option value="show_state" <?php if($al_options2[7] == 'show_state'){ ?>selected="selected"<?php } ?>>Show</option>
                                <option value="0" <?php if($al_options2[7] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                            </select>
                        </td>
					</tr>
					<tr>
                        <td width="20%">Show Country</td>
                        <td>
                            <select class="chosen-select form-control" name="show_country">
                                <option value="show_country" <?php if($al_options2[8] == 'show_country'){ ?>selected="selected"<?php } ?>>Show</option>
                                <option value="0" <?php if($al_options2[8] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                            </select>
						</td>
					</tr>
					<tr>
                        <td width="20%">Show Day of birth</td>
                        <td>
                            <select class="chosen-select form-control" name="show_daybirth">
                                <option value="show_daybirth" <?php if($al_options2[9] == 'show_daybirth'){ ?>selected="selected"<?php } ?>>Show</option>
                                <option value="0" <?php if($al_options2[9] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                            </select>
                        </td>
					</tr>
					<tr>
                        <td width="20%">Show Month of birth</td>
                        <td>
                            <select class="chosen-select form-control" name="show_monthbirth">
                                <option value="show_monthbirth" <?php if($al_options2[10] == 'show_monthbirth'){ ?>selected="selected"<?php } ?>>Show</option>
                                <option value="0" <?php if($al_options2[10] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                            </select>
                        </td>
					</tr>
					<tr>
                        <td width="20%">Show Year of birth</td>
                        <td>
                            <select class="chosen-select form-control" name="show_yearbirth">
                                <option value="show_yearbirth" <?php if($al_options2[11] == 'show_yearbirth'){ ?>selected="selected"<?php } ?>>Show</option>
                                <option value="0" <?php if($al_options2[11] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                            </select>
                        </td>
					</tr>
					<tr>
                        <td width="20%">Show Gender</td>
                        <td>
                            <select class="chosen-select form-control" name="show_gender">
                                <option value="show_gender" <?php if($al_options2[12] == 'show_gender'){ ?>selected="selected"<?php } ?>>Show</option>
                                <option value="0" <?php if($al_options2[12] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                            </select>
                        </td>
					</tr>
					<tr>
                        <td width="20%">Show Description</td>
                        <td>
                            <select class="chosen-select form-control" name="show_content">
                                <option value="show_content" <?php if($al_options2[13] == 'show_content'){ ?>selected="selected"<?php } ?>>Show</option>
                                <option value="0" <?php if($al_options2[13] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
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
            <input type="submit" class="btn btn-primary" name="post" value="Modify" />
        </div>
    </div>
</form>