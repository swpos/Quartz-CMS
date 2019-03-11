<?php echo $top_menu; ?>
<h1><?php echo LIST_CONTACT ?></h1>
<?php echo $error; ?>

<form action='index.php?page=Contact&action=contact_listed_admin_update' method='post' id="validator" role="form">
	<div class='row'>
		<div class='col-md-4'>
			<?php echo LIST_CONTACT_SEND_EMAIL_TO_ADMIN ?><br /> 
			<?php echo LIST_CONTACT_SEND_EMAIL_TO_ADMIN_YES ?> : <input type='radio' size='20' value='yes' name='send_email_admin' 
			<?php if ($al_fetch_contact_config->send_email_admin == 'yes') { echo"checked=\"checked\""; } ?> required /> 
			<?php echo LIST_CONTACT_SEND_EMAIL_TO_ADMIN_NO ?> : <input type='radio' size='20' value='no' name='send_email_admin' 
			<?php if ($al_fetch_contact_config->send_email_admin == 'no') {	echo"checked=\"checked\""; } ?> required />
		</div> 
		<div class='col-md-4'>
			<?php echo LIST_CONTACT_SEND_COMPLETE_EMAIL ?><br /> 
			<?php echo LIST_CONTACT_SEND_COMPLETE_EMAIL_YES ?> : <input type='radio' size='20' value='yes' name='send_complete_email' 
			<?php if ($al_fetch_contact_config->send_complete_mail == 'yes') { echo"checked=\"checked\""; } ?> required /> 
			<?php echo LIST_CONTACT_SEND_COMPLETE_EMAIL_NO ?> : <input type='radio' size='20' value='no' name='send_complete_email' 
			<?php if ($al_fetch_contact_config->send_complete_mail == 'no') { echo"checked=\"checked\""; } ?> required />
		</div> 
		<div class='col-md-4'>
			<?php echo LIST_CONTACT_SEND_TO_THESE_EMAIL ?><br /> <textarea name='email_user' required><?php echo $al_fetch_contact_config->users; ?></textarea>
		</div> 
	</div>
	<div class='row'>
		<div class='col-md-12'>
			<input type='submit' size='20' value='<?php echo BUTTON_UPDATE ?>' />
		</div>
	</div>
</form>
<div class="row">
	<div class="col-md-2">
		<form action='index.php?page=Contact&action=contact_listed' method='post'>
			<div class="well">
                <div class='row'>
                    <div class='col-md-12'>
                        <?php echo LIST_CONTACT_SEARCH_EMAIL ?>: <br /><input type='text' size='20' value='<?php echo $v->e($_SESSION['populate']['email_search_contact']); ?>' name='email_search_contact' />
                    </div>
                    <div class='col-md-12'>
                        <?php echo LIST_CONTACT_GENDER ?>: <br />
                        <select name='gender_contact' class="chosen-select">
                            <option value=''></option>
                            <option value='male' <?php
                            if ($v->d($_SESSION['populate']['gender_contact']) == "male") {
                                echo"selected='selected'";
                            }
                            ?>><?php echo LIST_CONTACT_GENDER_MALE ?></option>
                            <option value='female' <?php
                            if ($v->d($_SESSION['populate']['gender_contact']) == "female") {
                                echo"selected='selected'";
                            }
                            ?>><?php echo LIST_CONTACT_GENDER_FEMALE ?></option>		
                        </select>
                    </div>
                    <div class='col-md-12'>
                        <?php echo LIST_CONTACT_EMAIL ?>: <br />
                        <select name='email_contact' class="chosen-select">
                            <option value=''></option>
                            <?php echo $system_shortcut->gen_descAsc('email_contact'); ?>
                        </select>
                    </div>
                    <div class='col-md-12'>
                        <?php echo LIST_CONTACT_FIRST_NAME ?>: <br />
                        <select name='first_name_contact' class="chosen-select">
                            <option value=''></option>
                            <?php echo $system_shortcut->gen_descAsc('first_name_contact'); ?>
                        </select>
                    </div>
                    <div class='col-md-12'>
                        <?php echo LIST_CONTACT_LAST_NAME ?>: <br />
                        <select name='last_name_contact' class="chosen-select">
                            <option value=''></option>
                            <?php echo $system_shortcut->gen_descAsc('last_name_contact'); ?>
                        </select>
                    </div>
                    <div class='col-md-12'>
                        <?php echo LIST_CONTACT_PHONE ?>: <br />
                        <select name='phone_contact' class="chosen-select">
                            <option value=''></option>
                            <?php echo $system_shortcut->gen_descAsc('phone_contact'); ?>
                        </select>
                    </div>
                    <div class='col-md-12'>
                        <?php echo LIST_CONTACT_DATE ?>: <br />
                        <select name='date_contact' class="chosen-select">
                            <option value=''></option>
                            <?php echo $system_shortcut->gen_descAsc('date_contact'); ?>
                        </select>
                    </div>
                    <div class='col-md-12'>
                        <?php echo LIST_CONTACT_TIME ?>: <br />
                        <select name='time_contact' class="chosen-select">
                            <option value=''></option>
                            <?php echo $system_shortcut->gen_descAsc('time_contact'); ?>
                        </select>
                    </div>
                    <div class='col-md-12'>
                        <input type='submit' size='20' value='<?php echo BUTTON_SEARCH ?>' name='post_order_contact' />
                    </div>
                </div>
        	</div>        
		</form>
	</div>
	<div class="col-md-10">
		<table class='table-info list table-striped'>
			<thead>
				<tr>
					<th><?php echo LIST_MAIN_EMAIL ?></th>
					<th><?php echo LIST_MAIN_FIRST_NAME ?></th>
					<th><?php echo LIST_MAIN_LAST_NAME ?></th>
					<th><?php echo LIST_MAIN_PHONE ?></th>
					<th><?php echo LIST_MAIN_GENDER ?></th>
					<th><?php echo LIST_MAIN_DATE ?></th>
					<th><?php echo LIST_MAIN_TIME ?></th>
					<th><?php echo LIST_MAIN_ID ?></th>
					<th><?php echo LIST_MAIN_DELETE ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th><?php echo LIST_MAIN_EMAIL ?></th>
					<th><?php echo LIST_MAIN_FIRST_NAME ?></th>
					<th><?php echo LIST_MAIN_LAST_NAME ?></th>
					<th><?php echo LIST_MAIN_PHONE ?></th>
					<th><?php echo LIST_MAIN_GENDER ?></th>
					<th><?php echo LIST_MAIN_DATE ?></th>
					<th><?php echo LIST_MAIN_TIME ?></th>
					<th><?php echo LIST_MAIN_ID ?></th>
					<th><?php echo LIST_MAIN_DELETE ?></th>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach ($v->d_a($al_fetch_contacts) as $al_fetch_contact) { ?>
					<tr>
						<td>
							<a href='index.php?page=Contact&action=contact_show_contact&id_contact=<?php echo $al_fetch_contact->id ?>'><?php echo $al_fetch_contact->email ?></a>
						</td>
						<td>
							<?php echo $al_fetch_contact->first_name ?>
						</td>
						<td>
							<?php echo $al_fetch_contact->last_name ?>
						</td>
						<td>
							<?php echo $al_fetch_contact->phone ?>
						</td>
						<td>
							<?php echo $al_fetch_contact->gender ?>
						</td>
						<td>
							<?php echo $al_fetch_contact->date ?>
						</td>
						<td>
							<?php echo $al_fetch_contact->time ?>
						</td>
						<td>
							<?php echo $al_fetch_contact->id ?>
						</td>
						<td>
							<a href='index.php?page=Contact&action=contact_delete_contact&id_contact=<?php echo $al_fetch_contact->id ?>'><span class="icon glyphicon glyphicon-remove"></span></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php echo $system_pagination->pagination($al_init_contact_rows); ?>
	</div>
</div>