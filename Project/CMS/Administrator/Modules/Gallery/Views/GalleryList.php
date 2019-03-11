<?php echo $top_menu; ?>
<h1><?php echo LIST_GALLERY ?></h1>
<?php echo $error; ?>
<div class="row">
	<div class="col-md-2">
		<form action='index.php?page=Gallery&action=gallery_listed' method='post'>
			<div class="well">
                <div class='row'>
                    <div class='col-md-12'>
                        <?php echo LIST_GALLERY_TITLE_SEARCH ?>: <br /><input type='text' size='20' value='<?php echo $v->e($_SESSION['populate']['title_search_gallery']);	?>' name='title_search_gallery' />
                    </div> 
                    <div class='col-md-12'>
                        <?php echo LIST_GALLERY_TITLE ?>: <br />
                        <select name='title_gallery' class="chosen-select">
                            <option value=''></option>
                            <?php echo $system_shortcut->gen_descAsc('title_gallery'); ?>
                        </select>
                    </div>
                    <div class='col-md-12'>
                        <?php echo LIST_GALLERY_DATE ?>: <br />
                        <select name='date_gallery' class="chosen-select">
                            <option value=''></option>
                            <?php echo $system_shortcut->gen_descAsc('date_gallery'); ?>
                        </select>
                    </div> 
                    <div class='col-md-12'>
                        <?php echo LIST_GALLERY_TIME ?>: <br />
                        <select name='time_gallery' class="chosen-select">
                            <option value=''></option>		
                            <?php echo $system_shortcut->gen_descAsc('time_gallery'); ?>
                        </select>
                    </div>
                    <div class='col-md-12'>
                        <input type='submit' size='20' value='<?php echo BUTTON_SEARCH ?>' name='post_order_gallery' />
                    </div> 
                </div>
        	</div>
		</form>
	</div>
	<div class="col-md-10">
		<form action='index.php?page=Gallery&action=gallery_listed' method='post'>
			<table class='table-info list table-striped'>
				<thead>
					<tr>
						<th><?php echo LIST_MAIN_TITLE ?></th>
						<th><?php echo LIST_MAIN_DATE ?></th>
						<th><?php echo LIST_MAIN_TIME ?></th>
						<th><?php echo LIST_MAIN_SHORTCUT ?></th>
						<th><?php echo LIST_MAIN_ID_MODULE ?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo LIST_MAIN_TITLE ?></th>
						<th><?php echo LIST_MAIN_DATE ?></th>
						<th><?php echo LIST_MAIN_TIME ?></th>
						<th><?php echo LIST_MAIN_SHORTCUT ?></th>
						<th><?php echo LIST_MAIN_ID_MODULE ?></th>
					</tr>
				</tfoot>
				<tbody>
					<?php foreach ($v->d_a($al_fetch_galleries) as $al_fetch_gallery) { ?>
						<tr>
							<td>
								<a href='index.php?page=Gallery&action=gallery_show_gallery&id_gallery=<?php echo $al_fetch_gallery->id; ?>'><?php echo $al_fetch_gallery->title; ?></a>
							</td>
							<td>
								<?php echo $al_fetch_gallery->date; ?>
							</td>
							<td>
								<?php echo $al_fetch_gallery->time; ?>
							</td>
							<td>
								<?php $al_shortcut = str_replace(':', ' ', $al_fetch_gallery->shortcut); ?>
								<span class="label label-warning"><?php echo $al_shortcut; ?></span>
							</td>
							<td>
								<?php echo $al_fetch_gallery->id; ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</form>
		<?php echo $system_pagination->pagination($al_init_gallery_rows); ?>
	</div>
</div>