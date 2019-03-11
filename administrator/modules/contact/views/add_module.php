<?php include('../templates/'.loaddefaulttemplate($al_connexion).'/information.php'); ?>
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
                        <select class="chosen-select form-control" name="position">
                            <?php
                                foreach ($al_position as $al_values){	
                            ?>
                            	<option value="<?php echo $al_values; ?>"><?php echo $al_values; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Pages affected</td>
                    <td>
                        <ul>
                            <li><input type="checkbox" id="select_all"/> Check all/Uncheck all</li>
                            <?php
                                $select2=$al_connexion->query("SELECT * FROM ".HASH."_section_name");
                                $select2->setFetchMode(PDO::FETCH_OBJ);
                                while($al_fetch_section_name = $select2->fetch()){ 
                                    $al_id=decoding($al_fetch_section_name->id);
                                    $al_section=decoding($al_fetch_section_name->section);
                            ?>		
                                    <li style="float:left; margin:20px;"><?php echo $al_section; ?>
                                        <ul style="padding:0px; margin:0px; list-style-type:none;">
                            <?php		
                                    $select3=$al_connexion->query("SELECT * FROM ".HASH."_link_menu WHERE id_index='".$al_id."'");
                                    $select3->setFetchMode(PDO::FETCH_OBJ);
                        
                                    while($al_fetch_link_menu = $select3->fetch()){
                                        $al_name=decoding($al_fetch_link_menu->name);
                                        $al_shortcut_unique=decoding($al_fetch_link_menu->shortcut);
                            ?>
                                            <li><input type="checkbox" name="shortcut[]" value="<?php echo $al_shortcut_unique; ?>" > <?php echo $al_name; ?></li>
                            <?php
                                    }
                            ?>
                                        </ul>
                                    </li>
                            <?php       	
                                }
                            ?>
                        </ul>
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
            <input type="submit" class="btn btn-default" name="post" value="Add" />
        </div>
    </div>
</form>