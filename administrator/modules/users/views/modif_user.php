<?php 
	$al_id=decoding($al_fetch_users->id);
	$al_username=decoding($al_fetch_users->username);
	$al_first_name=decoding($al_fetch_users->first_name);
	$al_last_name=decoding($al_fetch_users->last_name);
	$al_email=decoding($al_fetch_users->email);
	$al_gender=decoding($al_fetch_users->gender);
	$al_city=decoding($al_fetch_users->city);
	$al_age=decoding($al_fetch_users->age);
	$al_about=decoding($al_fetch_users->about);
	$al_country=decoding($al_fetch_users->country);
?>
<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<form action="index.php?page=update_user" method="post" id="validator" role="form">
    <table class="table-striped">
        <tr>
            <td width="20%">Username</td>
            <td><input type="text" class="form-control" name="username" value="<?php echo $al_username ?>" /></td>
        </tr>
        <tr>
            <td width="20%">First name</td>
            <td><input type="text" class="form-control" name="first_name" value="<?php echo $al_first_name ?>" /></td>
        </tr>
        <tr>
            <td width="20%">Last name</td>
            <td><input type="text" class="form-control" name="last_name" value="<?php echo $al_last_name ?>" /></td>
        </tr>
        <tr>
            <td width="20%">Password</td>
            <td><input type="password" class="form-control" name="password" /></td>
        </tr>
        <tr>
            <td width="20%">Email</td>
            <td><input type="text" class="form-control" name="email" value="<?php echo $al_email ?>" /></td>
        </tr>
        <tr>
            <td width="20%">Gender</td>
            <td>
                Male : <input type="radio" name="gender" value="1" <?php if($al_gender==1){ ?>checked="checked"<?php } ?> /> 
                Female : <input type="radio" name="gender" value="0" <?php if($al_gender==0){ ?>checked="checked"<?php } ?> />
            </td>
        </tr>
        <tr>
            <td width="20%">City</td>
            <td><input type="text" class="form-control" name="city" value="<?php echo $al_city ?>" /></td>
        </tr>
        <tr>
            <td width="20%">Age</td>
            <td><input type="text" class="form-control" name="age" value="<?php echo $al_age ?>" /></td>
        </tr>
        <tr>
            <td width="20%">About</td>
            <td><textarea name="about"><?php echo $al_about ?></textarea></td>
        </tr>
        <tr>
            <td width="20%">Country</td>
            <td><input type="text" class="form-control" name="country" value="<?php echo $al_country ?>" /></td>
        </tr>
    </table>
    <input type="hidden" name="update" value="<?php echo $al_id ?>" />
    <input type="submit" class="btn btn-default" value="Modify" />
</form>