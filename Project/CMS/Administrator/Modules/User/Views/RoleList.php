<?php echo $top_menu; ?>
<h1><?php echo LIST_ROLE ?></h1>
<?php echo $error; ?>
<div class="row">
	<div class="col-md-2">
		<div class="well">
			<form action='index.php?page=User&action=role_listed' method='post'>
				<div class="row">
					<div class="col-md-12">
						<?php echo LIST_ROLES_ROLE_SEARCH ?>: <br />
						<input type='text' size='20' value='<?php echo $v->e($_SESSION['populate']['search_role']) ?>' name='search_role' />
					</div>
					<div class="col-md-12">
						<?php echo LIST_ROLES_ROLE ?>: <br />
						<select name='role_roles' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('role_roles'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<br />
						<input type='submit' size='20' value='<?php echo BUTTON_SEARCH ?>' name='post_order_role' />
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-10">
		<form action="index.php?page=User&action=role_delete" method="post">
			<table class="table-info list table-striped">
				<thead>
					<tr>
						<th><?php echo LIST_MAIN_ROLE ?></th>
						<th><?php echo LIST_MAIN_ROLE_NOTES ?></th>
						<th><?php echo LIST_MAIN_DELETE ?></th>
						<th><?php echo LIST_MAIN_ROLE_UPDATE_SEE_PROFILE ?></th>
					</tr>
				</thead>
		
				<tfoot>
					<tr>
						<th><?php echo LIST_MAIN_ROLE ?></th>
						<th><?php echo LIST_MAIN_ROLE_NOTES ?></th>
						<th><?php echo LIST_MAIN_DELETE ?></th>
						<th><?php echo LIST_MAIN_ROLE_UPDATE_SEE_PROFILE ?></th>
					</tr>
				</tfoot>
				<tbody>
					<?php foreach ($v->d_a($al_fetch_roles) as $al_fetch_roles) { ?>
						<tr>
							<td>
								<?php echo $al_fetch_roles->role ?>
							</td>
							<td>
								<?php echo $al_fetch_roles->notes ?>
							</td>
							<td>
								<input type='checkbox' value='<?php echo $al_fetch_roles->id ?>' name='delete[]' />
							</td>
							<td>
								<a href="index.php?page=User&action=role_edit&id=<?php echo $al_fetch_roles->id ?>"><span class="icon glyphicon glyphicon-pencil"></span><?php //echo LIST_MAIN_UPDATE_SEE_PROFILE ?></a>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
			<input type='submit' class='reorder' value='<?php echo BUTTON_DELETE ?>' />
		</form>
		<?php echo $system_pagination->pagination($al_init_roles_rows); ?>
	</div>
</div>