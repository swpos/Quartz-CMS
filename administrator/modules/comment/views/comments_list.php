<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>COMMENTS</h1>
<form action="index.php?page=list_comments" method="post" id="validator" role="form">
	<table class="table-striped">
		<tr>
            <td><input type="submit" class="btn btn-default" size="20" value="Search" name="post_order_comment" /></td>
            <td>Title: <br /><input type="text" class="form-control" size="20" value="<?php echo (isset($_SESSION['populate']['title_search_comment']) ? $_SESSION['populate']['title_search_comment'] : '') ?>" name="title_search_comment" /></td>
            <td>
                Title: <br />
                <select class="chosen-select form-control" name="title_comment">
                <option value=""></option>
                <option value="DESC" <?php if(isset($_SESSION['populate']['title_comment']) && $_SESSION['populate']['title_comment']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                <option value="ASC" <?php if(isset($_SESSION['populate']['title_comment']) && $_SESSION['populate']['title_comment']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                </select>
            </td>
            <td>Username: <br /><input type="text" class="form-control" size="20" value="<?php echo (isset($_SESSION['populate']['username_search_comment']) ? $_SESSION['populate']['username_search_comment'] : '') ?>" name="username_search_comment" /></td>
            <td>
                Username: <br />
                <select class="chosen-select form-control" name="username_comment">
                <option value=""></option>
                <option value="DESC" <?php if(isset($_SESSION['populate']['username_comment']) && $_SESSION['populate']['username_comment']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                <option value="ASC" <?php if(isset($_SESSION['populate']['username_comment']) && $_SESSION['populate']['username_comment']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                </select>
            </td>
            <td>
                Date: <br />
                <select class="chosen-select form-control" name="date_comment">
                <option value=""></option>
                <option value="DESC" <?php if(isset($_SESSION['populate']['date_comment']) && $_SESSION['populate']['date_comment']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                <option value="ASC" <?php if(isset($_SESSION['populate']['date_comment']) && $_SESSION['populate']['date_comment']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                </select>
            </td>
            <td>
                Time: <br />
                <select class="chosen-select form-control" name="time_comment">
                <option value=""></option>		
                <option value="DESC" <?php if(isset($_SESSION['populate']['time_comment']) && $_SESSION['populate']['time_comment']=="DESC"){ ?>selected="selected"<?php } ?>>Descending</option>
                <option value="ASC" <?php if(isset($_SESSION['populate']['time_comment']) && $_SESSION['populate']['time_comment']=="ASC"){ ?>selected="selected"<?php } ?>>Ascending</option>
                </select>
            </td>
		</tr>
	</table>
</form>
<form action="index.php?page=order_article" method="post" id="validator" role="form">
    <table class="table-striped">
        <tr>
            <td>Title</td>
            <td>Username</td>
            <td>Date</td>
            <td>Time</td>
            <td>Shortcut</td>
            <td>Id</td>
            <td>Delete</td>
        </tr>
	<?php
		while($al_fetch_comments = $select1->fetch()){	
			$al_id=decoding($al_fetch_comments->id);
			$al_title=decoding($al_fetch_comments->title);
			$al_username=decoding($al_fetch_comments->username);
			$al_date=decoding($al_fetch_comments->date);
			$al_time=decoding($al_fetch_comments->time);
			$al_shortcut=decoding($al_fetch_comments->shortcut);
			$al_shortcut=str_replace(':',' ',$al_shortcut);
	?>
			<tr>
                <td><a href="index.php?page=list_comments&action=show&id_comment=<?php echo $al_id ?>"><?php echo $al_title ?></a></td>
                <td><?php echo $al_username ?></td>
                <td><?php echo $al_date ?></td>
                <td><?php echo $al_time ?></td>
                <td><?php echo $al_shortcut ?></td>
                <td><?php echo $al_id ?></td>
                <td><a href="index.php?page=list_comments&action=delete&id_comment=<?php echo $al_id ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>
	<?php
    	}
	?>
	</table>
</form>
<?php echo pagination($al_init_comments_rows); ?>
		