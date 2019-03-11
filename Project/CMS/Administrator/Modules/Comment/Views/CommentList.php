<?php echo $top_menu; ?>
<h1><?php echo LIST_COMMENT ?></h1>
<?php echo $error; ?>
<div class="row">
	<div class="col-md-2">
		<form action='index.php?page=Comment&action=comment_listed_comments' method='post'>
			<div class="well">
                <div class="row">				
                    <div class="col-md-12">
                        <?php echo LIST_COMMENT_TITLE_SEARCH ?>: <br /><input type='text' size='20' value='<?php echo $v->e($_SESSION['populate']['title_search_comment']); ?>' name='title_search_comment' />
                    </div>
                    <div class="col-md-12">
                        <?php echo LIST_COMMENT_TITLE ?>: <br />
                        <select name='title_comment' class="chosen-select">
                            <option value=''></option>
                            <?php echo $system_shortcut->gen_descAsc('title_comment'); ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <?php echo LIST_COMMENT_USERNAME_SEARCH ?>: <br /><input type='text' size='20' value='<?php echo $v->e($_SESSION['populate']['username_search_comment']); ?>' name='username_search_comment' />
                    </div>
                    <div class="col-md-12">
                        <?php echo LIST_COMMENT_USERNAME ?>: <br />
                        <select name='username_comment' class="chosen-select">
                            <option value=''></option>
                            <?php echo $system_shortcut->gen_descAsc('username_comment'); ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <?php echo LIST_COMMENT_DATE ?>: <br />
                        <select name='date_comment' class="chosen-select">
                            <option value=''></option>
                            <?php echo $system_shortcut->gen_descAsc('date_comment'); ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <?php echo LIST_COMMENT_TIME ?>: <br />
                        <select name='time_comment' class="chosen-select">
                            <option value=''></option>
                            <?php echo $system_shortcut->gen_descAsc('time_comment'); ?>
                        </select>
                    </div>
					<div class="col-md-12">
                        <?php echo LIST_COMMENT_EMAIL ?>: <br />
                        <select name='email_comment' class="chosen-select">
                            <option value=''></option>
                            <?php echo $system_shortcut->gen_descAsc('email_comment'); ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <input type='submit' size='20' value='<?php echo BUTTON_SEARCH ?>' name='post_order_comment' />
                    </div>
                </div>
			</div>
        </form>
	</div>
	<div class="col-md-10">		
		<form action='index.php?page=Comment&action=comment_listed_comments' method='post'>
			<table class='table-info list table-striped'>
				<thead>
					<tr>
						<th><?php echo LIST_MAIN_TITLE ?></th>
						<th><?php echo LIST_MAIN_USERNAME ?></th>
						<th><?php echo LIST_MAIN_DATE ?></th>
						<th><?php echo LIST_MAIN_TIME ?></th>
						<th><?php echo LIST_MAIN_EMAIL ?></th>
						<th><?php echo LIST_MAIN_ID ?></th>
						<th><?php echo LIST_MAIN_DELETE ?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo LIST_MAIN_TITLE ?></th>
						<th><?php echo LIST_MAIN_USERNAME ?></th>
						<th><?php echo LIST_MAIN_DATE ?></th>
						<th><?php echo LIST_MAIN_TIME ?></th>
						<th><?php echo LIST_MAIN_EMAIL ?></th>
						<th><?php echo LIST_MAIN_ID ?></th>
						<th><?php echo LIST_MAIN_DELETE ?></th>
					</tr>
				</tfoot>
				<tbody>
					<?php foreach ($v->d_a($al_fetch_comments) as $al_fetch_comment) { ?>
						<tr>
							<td>
								<a href='index.php?page=Comment&action=comment_show_comment&id_comment=<?php echo $al_fetch_comment->id; ?>'><?php echo $al_fetch_comment->title; ?></a>
							</td>
							<td>
								<?php echo $al_fetch_comment->username; ?>
							</td>
							<td>
								<?php echo $al_fetch_comment->date; ?>
							</td>
							<td>
								<?php echo $al_fetch_comment->time; ?>
							</td>
							<td>
								<?php echo $al_fetch_comment->email; ?>
							</td>
							<td>
								<?php echo $al_fetch_comment->id; ?>
							</td>
							<td>
								<a href='index.php?page=Comment&action=comment_delete_comment&id_comment=<?php echo $al_fetch_comment->id; ?>'><span class="icon glyphicon glyphicon-remove"></span></a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</form>
		<?php echo $system_pagination->pagination($al_init_comments_rows); ?>
	</div>
</div>
