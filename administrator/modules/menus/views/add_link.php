<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>ADD LINK MENU</h1>
<form action="index.php?page=add_link&action=post" method="post" id="validator" role="form">
    <table class="table-striped">
        <tr>
            <td width="20%">Section</td>
            <td>
                <select class="chosen-select form-control" name="section">	
            <?php	
                $select1=$al_connexion->query("SELECT * FROM ".HASH."_section_name");
                $select1->setFetchMode(PDO::FETCH_OBJ);
                while($al_fetch_section_name = $select1->fetch()){
                    $al_section=decoding($al_fetch_section_name->section);
                    $al_id=decoding($al_fetch_section_name->id);
			?>
                    <option value="<?php echo $al_id ?>-<?php echo $al_section ?>"><?php echo $al_section ?></option>
            <?php
                }
			?>
                </select>
            </td>
        </tr>
        <tr>
            <td width="20%">New Links</td>
            <td>
                <input type="text" class="form-control" name="link[]" value="" size="30" /> <br />
                <input type="text" class="form-control" name="link[]" value="" size="30" /> <br />
                <input type="text" class="form-control" name="link[]" value="" size="30" /> <br />
                <input type="text" class="form-control" name="link[]" value="" size="30" /> <br />
                <input type="text" class="form-control" name="link[]" value="" size="30" /> <br />
                <input type="text" class="form-control" name="link[]" value="" size="30" /> <br />
            </td>
        </tr>
        <tr>
            <td width="20%"><input type="submit" class="btn btn-primary" name="post" value="Modify" /></td>
            <td></td>
        </tr>
    </table>
</form>