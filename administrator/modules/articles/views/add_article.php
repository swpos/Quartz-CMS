<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>ADD ARTICLE</h1>
<form action="index.php?page=add_article&action=post" method="post" id="validator" role="form">
    <div class="row">
        <div class="col-md-6">
            <table class="table-striped">
            	<tr>
                    <td width="20%">Title</td>
                    <td><input name="title" type="text" class="form-control" size="30" value="<?php echo isset($_SESSION['populate']['title']) ? $_SESSION['populate']['title'] : ''; ?>" /></td>
            	</tr>
                <tr>
                    <td width="20%">Attach to module</td>
                    <td>
                        <select class="chosen-select form-control" name="category">
                            <option value="">-NONE-</option>
                            <?php
                                $select2=$al_connexion->query("SELECT * FROM ".HASH."_category");
                                $select2->setFetchMode(PDO::FETCH_OBJ);
                            
                                while($al_fetch_category = $select2->fetch()){
                                    $al_category_listing = $al_fetch_category->category;
                            ?>
                                <option value="<?php echo $al_category_listing; ?>"><?php echo $al_category_listing; ?></option>
                            <?php
                                } 
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td width="20%">Publish</td>
                    <td>
                    	<select class="chosen-select form-control" name="publish">
                            <option value="1">published</option>
                            <option value="0">unpublished</option>
                        </select>
                	</td>
                </tr>
                <tr>
                    <td colspan="2"><h3>If not attach to a module <br />(pages, display options)</h3></td>
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
                    <td width="20%">Article</td>
                    <td></td>
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
                    <td width="20%">Show description</td>
                    <td>
                        <select class="chosen-select form-control" name="show_description">
                            <option value="show_description">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show username</td>
                    <td>
                        <select class="chosen-select form-control" name="show_username">
                            <option value="show_username">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show time</td>
                    <td>
                        <select class="chosen-select form-control" name="show_time">
                            <option value="show_time">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Show Date</td>
                    <td>
                        <select class="chosen-select form-control" name="show_date">
                            <option value="show_date">Show</option>
                            <option value="0">Hide</option>
                        </select>
                    </td>
                </tr>
            </table>
            <textarea cols="80" id="editor" name="value" rows="10"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="submit" class="btn btn-default" name="post" value="Modify" />
        </div>
    </div>
</form>