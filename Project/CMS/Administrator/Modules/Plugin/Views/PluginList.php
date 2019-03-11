<?php echo $top_menu; ?>
<h1><?php echo LIST_PLUGINS ?></h1>
<?php echo $error; ?>
<div class="row">
	<div class="col-md-2">
		<div class="well">
			<form action='index.php?page=Plugin&action=plugin_listed' method='post'>
				<div class="row"> 
					<div class="col-md-12">
						<input type='text' size='20' value='<?php echo $v->e($_SESSION['populate']['search_plugin']) ?>' name='search_plugin' />
					</div>
					<div class="col-md-12">
						<?php echo LIST_PLUGINS_TITLE ?>: <br />
						<select name='title_plugin' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('title_plugin'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_PLUGINS_DATE ?>: <br />
						<select name='date_plugin' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('date_plugin'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_PLUGINS_TIME ?>: <br />
						<select name='time_plugin' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('time_plugin'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_PLUGINS_PUBLISHED ?>: <br />
						<select name='published_plugin' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_pubUnpub('published_plugin'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<br />
						<input type='submit' size='20' value='<?php echo BUTTON_SEARCH ?>' name='post_order_plugin' />
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-10">
		<table class="table-info list table-striped">
			<thead>
				<tr>
					<th><?php echo LIST_MAIN_TITLE ?></th>
					<th><?php echo LIST_MAIN_DATE ?></th>
					<th><?php echo LIST_MAIN_TIME ?></th>
					<th><?php echo LIST_MAIN_PUBLISHED ?></th>
					<th><?php echo LIST_MAIN_DELETE ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><?php echo LIST_MAIN_TITLE ?></th>
					<th><?php echo LIST_MAIN_DATE ?></th>
					<th><?php echo LIST_MAIN_TIME ?></th>
					<th><?php echo LIST_MAIN_PUBLISHED ?></th>
					<th><?php echo LIST_MAIN_DELETE ?></th>
				</tr>
			</tfoot>
			<tbody>
				<?php
				foreach ($v->d_a($al_fetch_plugins) as $al_fetch_plugins) {
					if ($al_fetch_plugins->publish == 1) {
						$enable = 'Yes';
						$publishImage = "<span class='icon glyphicon glyphicon-ok-circle'></span>";
						$label_class="";
					} else {
						$enable = 'No';
						$publishImage = "<span class='icon glyphicon glyphicon-ban-circle'></span>";
						$label_class="class=\"label label-danger\"";
					}
					?>
					<tr>
						<td>
							<span <?php echo $label_class; ?>><?php echo $al_fetch_plugins->title ?></span>
						</td>
						<td>
							<?php echo $al_fetch_plugins->date ?>
						</td>
						<td>
							<?php echo $al_fetch_plugins->time ?>
						</td>
						<td>
							<a href='index.php?page=Plugin&action=plugin_publish&id_plugin=<?php echo $al_fetch_plugins->id; ?>&state=<?php echo $al_fetch_plugins->publish; ?>'><?php echo $publishImage; ?></a>
						</td>
						<td>
							<a href='index.php?page=Plugin&action=plugin_delete&id_plugin=<?php echo $al_fetch_plugins->id; ?>'><span class="icon glyphicon glyphicon-remove"></span></a>
						</td>
					</tr>
					<?php
				}
				?>
			</tbody>		
		</table>
		<?php echo $system_pagination->pagination($al_init_plugins_rows); ?>
	</div>
</div>