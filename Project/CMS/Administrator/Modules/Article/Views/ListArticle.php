<?php echo $top_menu; ?>
<h1><?php echo LIST_ARTICLE ?></h1>
<?php echo $error; ?>
<div class="row">
	<div class="col-md-2">
		<div class="well">
			<form action='index.php?page=Article&action=article_listed_article' method='post'>
				<div class="row">
					<div class="col-md-12">
						<?php echo LIST_ARTICLE_KEYWORD ?>: <br /><input type='text' value='<?php echo $v->e($_SESSION['populate']['search_article']) ?>' name='search_article' />
					</div>
					<div class="col-md-12">
						<?php echo LIST_ARTICLE_CATEGORY ?>: <br />
						<select name='category_article' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('category_article'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_ARTICLE_DATE ?>: <br />
						<select name='date_article' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('date_article'); ?>
						</select>
					</div>	
					<div class="col-md-12">
						<?php echo LIST_ARTICLE_TIME ?>: <br />
						<select name='time_article' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('time_article'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_ARTICLE_ORDER ?>: <br />
						<select name='order_article' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_descAsc('order_article'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<?php echo LIST_ARTICLE_PUBLISHED ?>: <br />
						<select name='published_article' class="chosen-select">
							<option value=''></option>
							<?php echo $system_shortcut->gen_pubUnpub('published_article'); ?>
						</select>
					</div>
					<div class="col-md-12">
						<br />
						<input type='submit' size='20' value='<?php echo BUTTON_SEARCH ?>' name='post_order_article' />
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-10">
		<form action='index.php?page=Article&action=article_listed_order' method='post'>
			<table class="table-info list table-striped">
				<thead>
					<tr>
						<th><?php echo LIST_MAIN_TITLE ?></th>
						<th><?php echo LIST_MAIN_CATEGORY ?></th>
						<th><?php echo LIST_MAIN_DATE ?></th>
						<th><?php echo LIST_MAIN_TIME ?></th>
						<th><?php echo LIST_MAIN_REORDER ?></th>
						<th><?php echo LIST_MAIN_SHORTCUT ?></th>
						<th><?php echo LIST_MAIN_PUBLISHED ?></th>
						<th><?php echo LIST_MAIN_DELETE ?></th>
					</tr>
				</thead>
		
				<tfoot>
					<tr>
						<th><?php echo LIST_MAIN_TITLE ?></th>
						<th><?php echo LIST_MAIN_CATEGORY ?></th>
						<th><?php echo LIST_MAIN_DATE ?></th>
						<th><?php echo LIST_MAIN_TIME ?></th>
						<th><?php echo LIST_MAIN_REORDER ?></th>
						<th><?php echo LIST_MAIN_SHORTCUT ?></th>
						<th><?php echo LIST_MAIN_PUBLISHED ?></th>
						<th><?php echo LIST_MAIN_DELETE ?></th>
					</tr>
				</tfoot>
				<tbody>
					<?php
					foreach ($v->d_a($al_fetch_articles) as $al_fetch_article) {
						if ($al_fetch_article->publish == 1) {
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
								<a <?php echo $label_class; ?> href='index.php?page=Article&action=article_edit_article&id_article=<?php echo $al_fetch_article->id; ?>'><?php echo $al_fetch_article->title; ?></a>
							</td>
							<td>
								<?php echo $al_fetch_article->category; ?>
							</td>
							<td>
								<?php echo $al_fetch_article->date; ?>
							</td>
							<td>
								<?php echo $al_fetch_article->time; ?>
							</td>
							<td>
								<input type='text' style="width:30px;" name='order[<?php echo $al_fetch_article->id; ?>]' value='<?php echo $al_fetch_article->order1; ?>' />
							</td>
							<td>
								<?php
									$al_shortcut_multiple = explode(":", $al_fetch_article->shortcut);
									for ($al_i = 0; $al_i < count($al_shortcut_multiple); $al_i++) {
										echo"<span class=\"label label-warning\">" . $al_shortcut_multiple[$al_i] . "</span>";
									}
								?>
							</td>
							<td>
								<a href='index.php?page=Article&action=article_listed_publish&id=<?php echo $al_fetch_article->id; ?>&state=<?php echo $enable ?>'><?php echo $publishImage ?></a>
							</td>
							<td>
								<a href='index.php?page=Article&action=article_listed_delete&id=<?php echo $al_fetch_article->id; ?>'><span class="icon glyphicon glyphicon-remove"></span></a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<input type='submit' class='reorder' value='<?php echo BUTTON_REORDER ?>' />
		</form>
		<?php echo $system_pagination->pagination($al_init_articles_rows); ?>
	</div>
</div>