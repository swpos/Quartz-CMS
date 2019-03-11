<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>		
<form action="index.php?page=media_show&action=delete" method="post" id="validator" role="form">
    <table class="table-striped">
        <tr>
            <td>Picture</td>
            <td>File name</td>
            <td>File size</td>
            <td>Delete</td>
        </tr>
        <?php 
			foreach($al_get_folders as $al_key => $al_value){
				if(($al_value!='..') && ($al_value!='.') && (!is_dir($al_value))){
		?>
            <tr>
                <td><img src="<?php echo $al_dir ?>/<?php echo $al_value ?>" /></td>
                <td><?php echo $al_value ?></td>
                <td><?php echo filesize("../media/".$al_value) ?> bytes</td>
                <td><input type="checkbox" name="images[]" value="<?php echo $al_value ?>"></td>
            </tr>
		<?php
			}
		}
		?>
	</table>
    <input type="submit" class="btn btn-default" value="Delete" />
</form>