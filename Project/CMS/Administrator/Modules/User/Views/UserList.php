<?php echo $top_menu; ?>
<h1><?php echo LIST_USER ?></h1>
<?php echo $error; ?>
<div class="row">
	<div class="col-md-2">
		<div class="well">
			<form action='index.php?page=User&action=user_listed' method='post'>
				<div class="row">
					<div class="col-md-12">
						<?php echo LIST_USER_USERNAME_SEARCH ?>: <br />
						<input type='text' size='20' value='<?php echo $v->e($_SESSION['populate']['search_user']) ?>' name='search_user' />
					</div>
					<div class="col-md-12">
						<?php echo LIST_USER_USERNAME ?>: <br />
						<select name='username_user' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('username_user'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_USER_FIRST_NAME_SEARCH ?>: <br />
						<input type='text' size='20' value='<?php echo $v->e($_SESSION['populate']['first_name_search_user']) ?>' name='first_name_search_user' />
					</div>
					<div class="col-md-12">
						<?php echo LIST_USER_FIRST_NAME ?>: <br />
						<select name='first_name_user' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('first_name_user'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_USER_LAST_NAME_SEARCH ?>: <br />
						<input type='text' size='20' value='<?php echo $v->e($_SESSION['populate']['last_name_search_user']) ?>' name='last_name_search_user' />
					</div>
					<div class="col-md-12">
						<?php echo LIST_USER_LAST_NAME ?>: <br />
						<select name='last_name_user' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('last_name_user'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_USER_EMAIL_SEARCH ?>: <br />
						<input type='text' size='20' value='<?php echo $v->e($_SESSION['populate']['email_search_user']); ?>' name='email_search_user' />
					</div>
					<div class="col-md-12">
						<?php echo LIST_USER_EMAIL ?>: <br />
						<select name='email_user' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('email_user'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<br />
						<input type='submit' size='20' value='<?php echo BUTTON_SEARCH ?>' name='post_order_user' />
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-10">
		<form action="index.php?page=User&action=user_delete" method="post">
			<table class="table-info list table-striped">
				<thead>
					<tr>
						<th><?php echo LIST_MAIN_USERNAME ?></th>
						<th><?php echo LIST_MAIN_FIRST_NAME ?></th>
						<th><?php echo LIST_MAIN_LAST_NAME ?></th>
						<th><?php echo LIST_MAIN_EMAIL ?></th>
						<th><?php echo LIST_MAIN_DELETE ?></th>
						<th><?php echo LIST_MAIN_UPDATE_SEE_PROFILE ?></th>
					</tr>
				</thead>
		
				<tfoot>
					<tr>
						<th><?php echo LIST_MAIN_USERNAME ?></th>
						<th><?php echo LIST_MAIN_FIRST_NAME ?></th>
						<th><?php echo LIST_MAIN_LAST_NAME ?></th>
						<th><?php echo LIST_MAIN_EMAIL ?></th>
						<th><?php echo LIST_MAIN_DELETE ?></th>
						<th><?php echo LIST_MAIN_UPDATE_SEE_PROFILE ?></th>
					</tr>
				</tfoot>
				<tbody>
					<?php foreach ($v->d_a($al_fetch_users) as $al_fetch_users) { ?>
						<tr>
							<td>
								<?php echo $al_fetch_users->username ?>
							</td>
							<td>
								<?php echo $al_fetch_users->first_name ?>
							</td>
							<td>
								<?php echo $al_fetch_users->last_name ?>
							</td>
							<td>
								<?php echo $al_fetch_users->email ?>
							</td>
							<td>
								<input type='checkbox' value='<?php echo $al_fetch_users->id ?>' name='delete[]' />
							</td>
							<td>
								<a href="index.php?page=User&action=user_edit&id=<?php echo $al_fetch_users->id ?>"><span class="icon glyphicon glyphicon-pencil"></span><?php //echo LIST_MAIN_UPDATE_SEE_PROFILE ?></a>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
			<input type='submit' class='reorder' value='<?php echo BUTTON_DELETE ?>' />
		</form>
		<?php echo $system_pagination->pagination($al_init_users_rows); ?>
	</div>
</div>