<?php
	$al_id=decoding($al_fetch_section_name->id);
	$al_section=decoding($al_fetch_section_name->section);
	$al_position_module=decoding($al_fetch_section_name->id_module);
?>
<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>CHOOSE PAGE OF MENU</h1>
<form action="index.php?page=menu&action=post_section&id_section=<?php echo $al_id ?>" method="post" id="validator" role="form">
	<table class="table-striped">
		<tr>
            <td width="20%">Section</td>
            <td><input name="title" type="text" class="form-control" size="30" value="<?php echo $al_section ?>" /></td>
        </tr>
		<tr>
        	<td width="20%">Pages contains in the menu</td>
            <td>
			   <?php 
                    $select2=$al_connexion->prepare("SELECT * FROM ".HASH."_section_name WHERE id_module = :al_id_module");
                    $select2->bindParam(':al_id_module', $al_id_module);
                    $select2->execute();
                    $select2->setFetchMode(PDO::FETCH_OBJ);
                    $al_fetch_section_name = $select2->fetch();
                    $al_id_section_name=decoding($al_fetch_section_name->id);
                    $select3=$al_connexion->query("SELECT * FROM ".HASH."_link_menu WHERE id_index='$al_id_section_name' OR id_index=''");
                    $select3->setFetchMode(PDO::FETCH_OBJ);
                    while($al_fetch_link_menu = $select3->fetch()){
                        $al_name=decoding($al_fetch_link_menu->name);
                        $al_id_index=decoding($al_fetch_link_menu->id_index);
                        $al_shortcut_unique=decoding($al_fetch_link_menu->shortcut);
                        if($al_id_index == $al_id_section_name){
                ?>
                            <p><input type="checkbox" name="shortcut[]" value="<?php echo $al_shortcut_unique ?>" checked="checked" /> Alias : <?php echo $al_shortcut_unique ?></p>
                <?php
                        } else {
                ?>
                            <p><input type="checkbox" name="shortcut[]" value="<?php echo $al_shortcut_unique ?>" /> Alias : <?php echo $al_shortcut_unique ?></p>
                <?php
                        }
                    }
                ?>
			</td>
        </tr>
        <tr>
            <td width="20%"><input type="submit" class="btn btn-primary" name="post" value="Modify" /></td>
            <td></td>
        </tr>
    </table>
</form>