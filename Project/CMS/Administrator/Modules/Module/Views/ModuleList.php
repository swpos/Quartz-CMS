<?php echo $top_menu; ?>
<h1><?php echo LIST_MODULE ?></h1>
<?php echo $error; 

$_SESSION['populate']['type_module'] = $v->d($_SESSION['populate']['type_module']);
$_SESSION['populate']['position_type_module'] = $v->d($_SESSION['populate']['position_type_module']);

?>
<div class="row">
	<div class="col-md-2">
		<div class="well">
			<form action='index.php?page=Module&action=module' method='post'>
				<div class="row">
					<div class="col-md-12">
						<input type='text' value='<?php echo $v->e($_SESSION['populate']['search_module']) ?>' name='search_module' />
					</div>
					<div class="col-md-12">
						<?php echo LIST_MODULE_CATEGORY ?>: <br />
						<select name='category_module' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('category_module'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_MODULE_TYPE ?>: <br />
						<select name='type_module' class="chosen-select">
							<option value=''></option>
							<?php foreach ($v->d_a($plugins) as $plugin) {
								$extension_full = "type_" . $plugin->content; ?>
								<option value='<?php echo $extension_full ?>' <?php if ($_SESSION['populate']['type_module'] == $extension_full) { echo"selected='selected'";}?> >
								<?php echo $plugin->title ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_MODULE_DATE ?>: <br />
						<select name='date_module' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('date_module'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_MODULE_TIME ?>: <br />
						<select name='time_module' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('time_module'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_MODULE_ORDER ?>: <br />
						<select name='order_module' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('order_module'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_MODULE_POSITION ?>: <br />
						<select name='position_module' class="chosen-select">
							<option value=''></option>	
							<?php echo $system_shortcut->gen_descAsc('position_module'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_MODULE_POSITION_TYPE ?>: <br />
						<select name='position_type_module' class="chosen-select">
							<option value=''></option>
							<?php
							include('../Templates/' . $system_template->loaddefaulttemplate() . '/information.php');
							foreach ($al_position as $key => $value) {
								?>
								<option value='<?php echo $value ?>' <?php
								if ($_SESSION['populate']['position_type_module'] == $value) {
									echo"selected='selected'";
								}
								?> ><?php echo $value ?></option>
										<?php
									}
									?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_MODULE_PUBLISHED ?>: <br />
						<select name='published_module' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_pubUnpub('published_module'); ?>	
						</select>
					</div>					
					<div class="col-md-12">
						<br />
						<input type='submit' value='<?php echo BUTTON_SEARCH ?>' name='post_order_module' />
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-10">
		<form action='index.php?page=Module&action=module_order' method='post'>
			<table class="table-info list table-striped">
				<thead>
					<tr>
						<th><?php echo LIST_MAIN_CATEGORY . "/" . LIST_MAIN_TITLE ?></th>
						<th><?php echo LIST_MAIN_TYPE ?></th>
						<th><?php echo LIST_MAIN_DATE ?></th>
						<th><?php echo LIST_MAIN_TIME ?></th>
						<th><?php echo LIST_MAIN_ORDER ?></th>
						<th><?php echo LIST_MAIN_POSITION ?></th>
						<th><?php echo LIST_MAIN_SHORTCUT ?></th>
						<th><?php echo LIST_MAIN_PUBLISHED ?></th>
						<th><?php echo LIST_MAIN_DELETE ?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo LIST_MAIN_CATEGORY . "/" . LIST_MAIN_TITLE ?></th>
						<th><?php echo LIST_MAIN_TYPE ?></th>
						<th><?php echo LIST_MAIN_DATE ?></th>
						<th><?php echo LIST_MAIN_TIME ?></th>
						<th><?php echo LIST_MAIN_ORDER ?></th>
						<th><?php echo LIST_MAIN_POSITION ?></th>
						<th><?php echo LIST_MAIN_SHORTCUT ?></th>
						<th><?php echo LIST_MAIN_PUBLISHED ?></th>
						<th><?php echo LIST_MAIN_DELETE ?></th>
					</tr>
				</tfoot>
				<tbody>
					<?php
					foreach ($v->d_a($al_fetch_modules) as $al_fetch_modules) {
						if (($al_fetch_modules->position != '') && ($al_fetch_modules->title != "hidden") && ($al_fetch_modules->id != 1)) {							
							$al_shortcut_multiple = explode(":", $al_fetch_modules->shortcut);
							
							$object = json_decode(html_entity_decode($al_fetch_modules->modules));
							$get_key = array_keys((array)$object);
							$type = str_replace('type_', '', $get_key[0]);
							
							if ($al_fetch_modules->published == 1) {
								$al_published = 'Yes';
								$publishImage = "<span class='icon glyphicon glyphicon-ok-circle'></span>";
								$label_class="";
							} else {
								$al_published = 'No';
								$publishImage = "<span class='icon glyphicon glyphicon-ban-circle'></span>";
								$label_class="class=\"label label-danger\"";
							}
							?>
							<tr>
								<td>
									<a <?php echo $label_class; ?> href='index.php?page=<?php echo ucfirst($type) ?>&action=_edit_module&id=<?php echo $al_fetch_modules->id; ?>'><?php echo $al_fetch_modules->category ?></a>
								</td>
								<td>
									<?php echo $type ?>
								</td>
								<td>
									<?php echo $al_fetch_modules->date ?>
								</td>
								<td>
									<?php echo $al_fetch_modules->time ?>
								</td>
								<td>
									<input type='text' style="width:30px;" value='<?php echo $al_fetch_modules->order1 ?>' name='order[<?php echo $al_fetch_modules->id ?>]' />
								</td>
								<td>
									<?php echo $al_fetch_modules->position ?>
								</td>
								<td>
									<?php for ($al_i = 0; $al_i < count($al_shortcut_multiple); $al_i++) { ?>
										<span class="label label-warning"><?php echo $al_shortcut_multiple[$al_i] ?></span>
									<?php } ?>
								</td>
								<td>
									<a href="index.php?page=Module&action=module_publish&id=<?php echo $al_fetch_modules->id ?>&state=<?php echo $al_fetch_modules->published ?>" title="Published/Unpublished"><?php echo $publishImage ?></a>
								</td>
								<td>
									<a href="index.php?page=<?php echo ucfirst($type) ?>&action=_delete_module&id=<?php echo $al_fetch_modules->id ?>" title="Delete"><span class="icon glyphicon glyphicon-remove"></span></a>
								</td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
			<input type='submit' class='reorder' value='<?php echo BUTTON_REORDER ?>' />
		</form>
		<?php echo $system_pagination->pagination($al_init_modules_rows); ?>
	</div>
</div>	