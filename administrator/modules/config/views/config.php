<?php
	$al_title=decoding($al_fetch_config->title);
	$al_emailadmin=decoding($al_fetch_config->emailadmin);
	$al_pause=decoding($al_fetch_config->pause);
	if($al_pause=='0'){$pause_enable='No';}else{$pause_enable='Yes';}
	include('../config.php');
?>
<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>CONFIGURATION</h1>
<form action="index.php?page=post_configuration" method="post" id="validator" role="form">
    <p>To modifiy the MySQL configuration add write permission on the configuration file at the root of the site. (write permission are (755 : Best solution) or 775)</p>
    <table class="table-striped">
        <tr>
            <td>Title</td>
            <td>Email of the admin</td>
            <td>Maintenance</td>
            <td>Editor</td>
        </tr>
        <tr>
            <td><input type="text" class="form-control" value="<?php echo $al_title ?>" name="title" /></td>
            <td><input type="text" class="form-control" value="<?php echo $al_emailadmin ?>" name="emailadmin" /></td>
            <td>
                Yes <input type="radio" value="1" name="pause" <?php if($al_pause=='1'){ ?>checked="checked"<?php } ?> /> 
                No <input type="radio" value="0" name="pause" <?php if($al_pause=='0'){ ?>checked="checked"<?php } ?> />
            </td>
            <td>
                <select class="chosen-select form-control" name="editor">
                    <option value="none">NONE</option>
                    <option value="ckeditor" <?php if($editor=='ckeditor'){ ?>selected="selected"<?php } ?>>CKeditor</option>
                </select>
            </td>
        </tr>
    </table>
    <p><strong>MySQL Informations</strong></p>
    <table class="table-striped">
        <tr>
            <td>MySQL Host</td>
            <td>Database User</td>
            <td>Database Password</td>
            <td>Database Name</td>
        </tr>
        <tr>
            <td><input type="text" class="form-control" name="al_host" value="<?php echo $al_host ?>" /></td>
            <td><input type="text" class="form-control" name="al_user" value="<?php echo $al_user ?>" /></td>
            <td><input type="password" class="form-control" name="al_password" value="" /></td>
            <td><input type="text" class="form-control" name="al_db_name" value="<?php echo $al_db_name ?>" /></td>
        </tr>
    </table>
    <br />
    Table Prefix : <input type="text" class="form-control" name="al_hash" value="<?php echo HASH ?>" />
    <br /><br />
    <input type="submit" class="btn btn-default" value="Update" />
</form>