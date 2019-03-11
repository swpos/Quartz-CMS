<?php echo $top_menu; ?>
<h1><?php echo EDIT_LINK_MENU ?></h1>
<?php echo $error; ?>
<form action="index.php?page=Menu&action=menu_listed_menu_link_update&id_link=<?php echo $id ?>" method="post" id="validator" role="form">
    <div class='row'>
        <div class='col-md-12'>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title" align="center">
						<?php echo $sectionName->section ?>
					</h2>
				</div>
				<div class="panel-body">
					<table class="table-info list table-striped">
						<thead>
							<tr>
								<th><?php echo EDIT_LINK_MENU_ALIAS ?></th>
								<th><?php echo EDIT_LINK_MENU_NAME ?></th>
								<th>#</th>
                                <th><?php echo EDIT_LINK_MENU_REGISTER ?></th>
								<th><?php echo EDIT_LINK_MENU_SUB_MENU ?></th>
							</tr>
						</thead>
				
						<tfoot>
							<tr>
								<th><?php echo EDIT_LINK_MENU_ALIAS ?></th>
								<th><?php echo EDIT_LINK_MENU_NAME ?></th>
                                <th>#</th>
                                <th><?php echo EDIT_LINK_MENU_REGISTER ?></th>
								<th><?php echo EDIT_LINK_MENU_SUB_MENU ?></th>
							</tr>
						</tfoot>
						<tbody>
							<?php foreach ($v->d_a($menuLinks) as $link) { ?>
								<tr>
									<td>
										<input name='alias[<?php echo $link->id ?>]' type='text' size='30' value='<?php echo $link->shortcut ?>' />
										<input name='old_alias[<?php echo $link->id ?>]' type='hidden' value='<?php echo $link->shortcut ?>' />
                                    </td>
									<td>
										<input name='shortcut[<?php echo $link->id ?>]' type='text' size='30' value='<?php echo $link->name ?>' required />
									</td>
									<td>
										<input type='text' style="width:20px;" name='order[<?php echo $link->id ?>]' value='<?php echo $link->order1 ?>' />
									</td>
                                    <td>
                                    	<select name="register[<?php echo $link->id; ?>]" class="chosen-select">
											<option value="0" <?php if($link->register == 0){ echo "selected=\"selected\""; } ?>><?php echo REGISTER_ACCESS_OFF ?></option>
                                            <option value="1" <?php if($link->register == 1){ echo "selected=\"selected\""; } ?>><?php echo REGISTER_ACCESS_ON ?></option>
										</select>	
                                    </td>
									<td>
										<select name="id_menu[<?php echo $link->id; ?>]" class="chosen-select">
											<option value="0"><?php echo EDIT_LINK_MENU_SUB_MENU_NONE ?></option>
											<?php foreach ($v->d_a($sections) as $section) { ?>
												<option value="<?php echo $section->id ?>"
												<?php
												if ($section->id == $link->sub_menu) {
													echo "selected=\"selected\"";
												}
												?>><?php echo $section->section ?></option><?php 
												}
											?>
										</select>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class='col-md-12'>
					<input type="submit" name="post" value="<?php echo BUTTON_MODIFY ?>" />
				</div>
			</div>
        </div>
    </div>
</form>