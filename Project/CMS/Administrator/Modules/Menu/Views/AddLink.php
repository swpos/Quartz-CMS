<?php echo $top_menu; ?>
<h1><?php echo ADD_LINK_MENU ?></h1>
<?php echo $error; ?>
<form action="index.php?page=Menu&action=menu_add_link_update" method="post" id="validator" role="form">
    <div class='row'>
        <div class='col-md-12'>
            <table class="table-info table-striped">
                <tr>
                    <td width="25%">
                        <h3><?php echo ADD_LINK_MENU_SECTION ?></h3>  
                    </td>
                    <td>
                        <select name='section' class="chosen-select">		
                            <?php foreach ($v->d_a($al_fetch_section_name) as $al_fetch_section_name) { ?>
                                <option value='<?php echo $al_fetch_section_name->id ?>-<?php echo $al_fetch_section_name->section ?>'><?php echo $al_fetch_section_name->section ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3><?php echo ADD_LINK_MENU_NEW_LINKS ?></h3>
                    </td>
                    <td>
                        <p><input type='text' name='link[]' value='' size='30' required /></p>
                        <p><input type='text' name='link[]' value='' size='30' /></p>
                        <p><input type='text' name='link[]' value='' size='30' /></p>
                        <p><input type='text' name='link[]' value='' size='30' /></p>
                        <p><input type='text' name='link[]' value='' size='30' /></p>
                        <p><input type='text' name='link[]' value='' size='30' /></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="post" value="<?php echo BUTTON_MODIFY ?>" />
                    </td>
                    <td>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>
