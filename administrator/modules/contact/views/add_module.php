<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>ADD CONTACT MODULE</h1>
<form action="index.php?page=addmodule&action=post_contact" method="post" id="validator" role="form">
    <div class="row">
        <div class="col-md-6">
            <table class="table-striped">
                <tr>
                	<td width="20%">Title</td>
                    <td><input name="title" type="text" class="form-control" size="30" value="<?php echo isset($_SESSION['populate']['title']) ? $_SESSION['populate']['title'] : ''; ?>" /></td>
                </tr>
                <tr>
                    <td width="20%">Type of module</td>
                    <td>Contact</td>
                </tr>
                <tr>
                    <td width="20%">Position</td>
                    <td>
                        <?php echo add_position($al_connexion); ?>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Pages affected</td>
                    <td>
                    	<?php echo add_shortcut($al_connexion); ?>
                    </td>
                </tr>
			</table>
		</div>
		<div class="col-md-6">
            <table class="table-striped">
                <tr>
                    <td width="20%">Article</td><td></td>
                </tr>
                <tr>
                    <td width="20%">Show title</td>
                    <td>
                        <select class="chosen-select form-control" name="show_title">
                            <option value="show_title">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Options Form</td><td></td>
                </tr>
                <tr>
                    <td width="20%">Show first name</td>
                    <td>
                        <select class="chosen-select form-control" name="show_first_name">
                            <option value="show_first_name">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show last name</td>
                    <td>
                        <select class="chosen-select form-control" name="show_last_name">
                            <option value="show_last_name">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show email</td>
                    <td>
                        <select class="chosen-select form-control" name="show_email">
                            <option value="show_email">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show phone</td>
                    <td>
                        <select class="chosen-select form-control" name="show_phone">
                            <option value="show_phone">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show postal code</td>
                    <td>
                        <select class="chosen-select form-control" name="show_postal_code">
                            <option value="show_postal_code">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show city</td>
                    <td>
                        <select class="chosen-select form-control" name="show_city">
                            <option value="show_city">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show state</td>
                    <td>
                        <select class="chosen-select form-control" name="show_state">
                            <option value="show_state">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show country</td>
                    <td>
                        <select class="chosen-select form-control" name="show_country">
                            <option value="show_country">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show Day birth</td>
                    <td>
                        <select class="chosen-select form-control" name="show_daybirth">
                            <option value="show_daybirth">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show Month birth</td>
                    <td>
                        <select class="chosen-select form-control" name="show_monthbirth">
                            <option value="show_monthbirth">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show Year birth</td>
                    <td>
                        <select class="chosen-select form-control" name="show_yearbirth">
                            <option value="show_yearbirth">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show gender</td>
                    <td>
                        <select class="chosen-select form-control" name="show_gender">
                            <option value="show_gender">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>	
                <tr>
                    <td width="20%">Show description</td>
                    <td>
                        <select class="chosen-select form-control" name="show_content">
                            <option value="show_content">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">	
            <input type="submit" class="btn btn-primary" name="post" value="Add" />
        </div>
    </div>
</form>