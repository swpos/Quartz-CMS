<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>TEMPLATE</h1>
<form action="index.php?page=post_template" method="post" id="validator" role="form">
    <table class="table-striped list">
        <tr>
            <td>Preview</td>
            <td>Name</td>
            <td>Description</td>
            <td>Date Updated</td>
            <td>Time Updated</td>
            <td>Active</td>
        </tr>
        <?php
			foreach($al_get_folders as $al_key => $al_value){
				if(($al_value!='..') && ($al_value!='.') && ($al_value!='admin')){
					$select1=$al_connexion->query("SELECT * FROM ".HASH."_template WHERE title='".$al_value."'");
					$select1->setFetchMode(PDO::FETCH_OBJ);
					$al_fetch_template = $select1->fetch();
		?>	
            <tr>
                <td width="150"><img src="../templates/<?php echo $al_value ?>/preview.jpg" style="width:100%; height:auto;" /></td>
                <td><?php echo $al_value ?></td>
                <td><textarea name="description[<?php echo decoding($al_fetch_template->id) ?>]"><?php echo decoding($al_fetch_template->description) ?></textarea></td>
                <td><?php echo decoding($al_fetch_template->date) ?></td>
                <td><?php echo decoding($al_fetch_template->time) ?></td>
                <td><input type="radio" name="active" value="1-<?php echo decoding($al_fetch_template->id) ?>" <?php if(decoding($al_fetch_template->active)=='1'){ ?>checked="checked" <?php } ?>/></td>
        	<tr>	
		<?php
				}
			}
		?>
	</table>
	<input type="submit" class="btn btn-primary" value="Update" />
</form>