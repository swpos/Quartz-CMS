<?php	
    $al_send_email_admin = $al_fetch_contact_config->send_email_admin;
    $al_send_complete_mail = $al_fetch_contact_config->send_complete_mail;
    $al_send_users = $al_fetch_contact_config->users;
?>
<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>CONTACT</h1>
<form action="index.php?page=list_contact&action=post_admin" method="post" id="validator" role="form">
    <table class="table-striped">
   		<tr>
            <td>
                Send email to admin(yes) or the email in the list(no)<br /> 
                Yes : <input type="radio" size="20" value="yes" name="send_email_admin" <?php if($al_send_email_admin=='yes'){ ?>checked="checked"<?php } ?>  /> 
                No : <input type="radio" size="20" value="no" name="send_email_admin" <?php if($al_send_email_admin=='no'){ ?>checked="checked"<?php } ?> />
            </td>
            <td>
                Send complete email(yes) or send simple email(no)<br /> 
                Yes : <input type="radio" size="20" value="yes" name="send_complete_email" <?php if($al_send_complete_mail=='yes'){ ?>checked="checked" <?php } ?>  /> 
                No : <input type="radio" size="20" value="no" name="send_complete_email" <?php if($al_send_complete_mail=='no'){ ?>checked="checked" <?php } ?>  />
            </td>
            <td>
                Send to these email (only if 'Send email to admin' is set to 'no')<br /> 
                *Use comma to seperate email E.g : test@gmail.com,test@gmail<br /> 
                <textarea name="email_user"><?php echo $al_send_users ?></textarea>
            </td>
		</tr>
		<tr>
			<td><input type="submit" class="btn btn-default" size="20" value="Update" /></td>
		</tr>
	</table>
</form>
<form action="index.php?page=list_contact" method="post" id="validator" role="form">
	<table class="table-striped">
		<tr>
            <td>
                <input type="submit" class="btn btn-default" size="20" value="Search" name="post_order_contact" />
            </td>
            <td>
                Email: <br />
                <input type="text" class="form-control" size="20" value="<?php echo (isset($_SESSION['populate']['email_search_contact']) ? $_SESSION['populate']['email_search_contact'] : ''); ?>" name="email_search_contact" />
            </td>
            <td>
                Gender: <br />
                <select class="chosen-select form-control" name="gender_contact">
                    <option value=""></option>
                    <option value="male" <?php if(isset($_SESSION['populate']['gender_contact']) && $_SESSION['populate']['gender_contact']=="male"){ ?>selected="selected"<?php } ?>>Male</option>
                    <option value="female" <?php if(isset($_SESSION['populate']['gender_contact']) && $_SESSION['populate']['gender_contact']=="female"){ ?>selected="selected"<?php } ?>>Female</option>		
                </select>
            </td>
            <td>
                Email: <br />
                <select class="chosen-select form-control" name="email_contact">
                    <option value=""></option>
                    <option value="DESC" <?php if(isset($_SESSION['populate']['email_contact']) && $_SESSION['populate']['email_contact']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                    <option value="ASC" <?php if(isset($_SESSION['populate']['email_contact']) && $_SESSION['populate']['email_contact']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                </select>
            </td>
            <td>
                First name: <br />
                <select class="chosen-select form-control" name="first_name_contact">
                    <option value=""></option>
                    <option value="DESC" <?php if(isset($_SESSION['populate']['first_name_contact']) && $_SESSION['populate']['first_name_contact']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                    <option value="ASC" <?php if(isset($_SESSION['populate']['first_name_contact']) && $_SESSION['populate']['first_name_contact']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                </select>
            </td>
            <td>
                Last name: <br />
                <select class="chosen-select form-control" name="last_name_contact">
                    <option value=""></option>
                    <option value="DESC" <?php if(isset($_SESSION['populate']['last_name_contact']) && $_SESSION['populate']['last_name_contact']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                    <option value="ASC" <?php if(isset($_SESSION['populate']['last_name_contact']) && $_SESSION['populate']['last_name_contact']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                </select>
            </td>
            <td>
                Phone: <br />
                <select class="chosen-select form-control" name="phone_contact">
                    <option value=""></option>		
                    <option value="DESC" <?php if(isset($_SESSION['populate']['phone_contact']) && $_SESSION['populate']['phone_contact']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                    <option value="ASC" <?php if(isset($_SESSION['populate']['phone_contact']) && $_SESSION['populate']['phone_contact']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                </select>
            </td>
            <td>
                Date: <br />
                <select class="chosen-select form-control" name="date_contact">
                    <option value=""></option>		
                    <option value="DESC" <?php if(isset($_SESSION['populate']['date_contact']) && $_SESSION['populate']['date_contact']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                    <option value="ASC" <?php if(isset($_SESSION['populate']['date_contact']) && $_SESSION['populate']['date_contact']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                </select>
            </td>
            <td>
                Time: <br />
                <select class="chosen-select form-control" name="time_contact">
                    <option value=""></option>		
                    <option value="DESC" <?php if(isset($_SESSION['populate']['time_contact']) && $_SESSION['populate']['time_contact']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                    <option value="ASC" <?php if(isset($_SESSION['populate']['time_contact']) && $_SESSION['populate']['time_contact']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                </select>
            </td>
        </tr>
	</table>
</form>
<div class="list">
	<table class="table-striped">
		<tr>
            <td>Email</td>
            <td>First name</td>
            <td>Last name</td>
            <td>Phone</td>
            <td>Gender</td>
            <td>Date</td>
            <td>Time</td>
            <td>Id</td>
            <td>Delete</td>
		</tr>
	<?php
		while($al_fetch_contact = $select1->fetch()){	
			$al_id=decoding($al_fetch_contact->id);
			$al_email=decoding($al_fetch_contact->email);
			$al_first_name=decoding($al_fetch_contact->first_name);
			$al_last_name=decoding($al_fetch_contact->last_name);
			$al_phone=decoding($al_fetch_contact->phone);
			$al_gender=decoding($al_fetch_contact->gender);
			$al_date=decoding($al_fetch_contact->date);
			$al_time=decoding($al_fetch_contact->time);
			$al_shortcut=decoding($al_fetch_contact->shortcut);
			$al_shortcut=str_replace(':',' ',$al_shortcut);
	?>
		<tr>
			<td><a href="index.php?page=list_contact&action=show&id_contact=<?php echo $al_id ?>"><?php echo $al_email ?></a></td>
			<td><?php echo $al_first_name ?></td>
			<td><?php echo $al_last_name ?></td>
			<td><?php echo $al_phone ?></td>
			<td><?php echo $al_gender ?></td>
			<td><?php echo $al_date ?></td>
			<td><?php echo $al_time ?></td>
			<td><?php echo $al_id ?></td>
			<td><a href="index.php?page=list_contact&action=delete&id_contact=<?php echo $al_id ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>
	<?php	
        }
	?>
	</table>
</div>
<?php echo pagination($al_init_contact_rows); ?>