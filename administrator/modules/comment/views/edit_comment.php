<?php
	$al_id=decoding($al_fetch_comments->id);
	$al_title=decoding($al_fetch_comments->title);
	$al_username=decoding($al_fetch_comments->username);
	$al_date=decoding($al_fetch_comments->date);
	$al_time=decoding($al_fetch_comments->time);
	$al_shortcut=decoding($al_fetch_comments->shortcut);
	$al_content=decoding($al_fetch_comments->content);
	$al_shortcut=str_replace(':',', ',$al_shortcut);
?>
<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>EDIT COMMENT</h1>
<form action="index.php?page=list_comments&action=update_comment&id_comment=<?php echo $al_id ?>" method="post" id="validator" role="form">
    <table class="table-striped">
        <tr>
            <td width="20%">Title</td>
            <td><input type="text" class="form-control" value="<?php echo $al_title ?>" name="title" /></td>
        </tr>
        <tr>
            <td width="20%">Username</td>
            <td><input type="text" class="form-control" value="<?php echo $al_username ?>" name="username" /></td>
        </tr>
        <tr>
            <td width="20%">Date</td>
            <td><?php echo $al_date ?></td>
        </tr>
        <tr>
            <td width="20%">Time</td>
            <td><?php echo $al_time ?></td>
        </tr>
        <tr>
            <td width="20%">Shortcut</td>
            <td><?php echo $al_shortcut ?></td>
        </tr>
        <tr>
            <td width="20%">Id</td>
            <td><?php echo $al_id ?></td>
        </tr>
    </table>
    <textarea cols="80" id="editor" name="value" rows="10"><?php echo $al_content ?></textarea>
    <input type="submit" class="btn btn-default" value="Modify" />
</form>