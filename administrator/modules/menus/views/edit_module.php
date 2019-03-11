<?php
	$al_id=$al_fetch_modules->id;
	$al_category=decoding($al_fetch_modules->category);
	$al_modules=decoding($al_fetch_modules->modules);
	$al_title=decoding($al_fetch_modules->title);
	$al_position_module=decoding($al_fetch_modules->position);
	$al_date=decoding($al_fetch_modules->date);
	$al_time=decoding($al_fetch_modules->time);
	$al_shortcut_multiple=decoding(explode(':',$al_fetch_modules->shortcut));
	$al_shortcut_multiple2=decoding($al_fetch_modules->shortcut);
?>
<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>EDIT MENU MODULE</h1>
<form action="index.php?page=menu&action=post_menu&id=<?php echo $al_id; ?>" method="post" id="validator" role="form">
    <div class="row">
        <div class="col-md-6">
            <input name="category" type="hidden" size="30" value="<?php echo $al_category; ?>" />
            <table class="table-striped">
                <tr>
                    <td width="20%">Title</td>
                    <td><input name="title" type="text" class="form-control" size="30" value="<?php echo $al_title; ?>" /></td>
                </tr>
                <tr>
                    <td width="20%">Type of module</td>
                    <td>Menu</td>
                </tr>		
                <tr>
                    <td width="20%">Date created</td>
                    <td><?php echo $al_date; ?></td>
                </tr>		
                <tr>
                    <td width="20%">Hour created</td>
                    <td><?php echo $al_time; ?></td>
                </tr>
                <tr>
                    <td width="20%">Position</td>
                    <td>
                        <?php echo modify_position($al_connexion, $al_position_module); ?>
                    </td>
                </tr>
                <tr>
                	<td width="20%">Page of the menu</td>
                    <td>
                    	<ul>
						<?php
                            $select2=$al_connexion->prepare("SELECT * FROM ".HASH."_section_name WHERE id_module = :al_id_module");
                            $select2->bindParam(':al_id_module', $al_id_module);
                            $select2->execute();
                            $select2->setFetchMode(PDO::FETCH_OBJ);
    
                            while($al_fetch_section_name = $select2->fetch()){
                                $al_section=decoding($al_fetch_section_name->section);
                                $al_id_menu=decoding($al_fetch_section_name->id);
                        ?>		
                            <li><a href="index.php?page=menu&action=section_link&id=<?php echo $al_id ?>&id_section=<?php echo $al_id_menu ?>&id_module=<?php echo $al_id_module ?>"><?php echo $al_section ?></a>
                                <ul>
                                    <?php
                                        $select3=$al_connexion->query("SELECT * FROM ".HASH."_link_menu WHERE id_index='".$al_id_menu."'");
                                        $select3->setFetchMode(PDO::FETCH_OBJ);
                                                    
                                        while($al_fetch_link_menu = $select3->fetch()){
                                            $al_name=decoding($al_fetch_link_menu->name);
                                            $al_shortcut_unique=decoding($al_fetch_link_menu->shortcut);
                                            $al_id_link=decoding($al_fetch_link_menu->id);
                                            $al_order1=decoding($al_fetch_link_menu->order1);
                                    ?>
                                        <li>
                                            <a href="index.php?page=menu&action=link&id=<?php echo $al_id ?>&id_link=<?php echo $al_id_link ?>"><?php echo $al_name ?></a> 
                                            <a href="index.php?page=menu&action=delete_link&id_link=<?php echo $al_id_link ?>"><span class="glyphicon glyphicon-remove"></span></a> 
                                            # <input type="text" class="form-control" name="order[<?php echo $al_id_link ?>]" value="<?php echo $al_order1 ?>" />
                                        </li>
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
                <tr>
                    <td width="20%">Pages affected</td>
                    <td>
                        <?php echo modify_shortcut($al_connexion, $al_shortcut_multiple); ?>
                    </td>
                </tr>
                <tr>
                    <td width="20%">Id of the module</td>
                    <td><?php echo $al_id_module ?><input type="hidden" name="id" value="<?php echo $al_id ?>" /></td>
                </tr>
			</table>
		</div>
		<div class="col-md-6">
			<table class="table-striped">
		<?php 
				if(preg_match('/\{(.*?)\}$/', $al_modules, $al_match)) { 
					if(preg_match('/\{(.*?)\}$/',$al_match[1],$al_match2)) {
		?>
				<tr>
                	<td width="20%"><h3>Category</h3></td>
                    <td></td>
                </tr>
		<?php	
				if(preg_match('/category\{(.*?)\}/',$al_match2[1],$al_match3)) {	
					$al_options2 = explode(':',$al_match3[1]);
		?>
            	<tr>
                	<td width="20%">Show title</td>
                    <td>
                        <select class="chosen-select form-control" name="show_title_category">
                            <option value="show_title" <?php if($al_options2[0] == 'show_title'){ ?>selected="selected"<?php } ?>>Show</option>
                            <option value="0" <?php if($al_options2[0] == '0'){ ?>selected="selected"<?php } ?>>Hide</option>
                        </select>
					</td>
				</tr>
		<?php
                }
            }
        }
        ?>
			</table>
		</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="submit" class="btn btn-primary" name="post" value="Modify" />
        </div>
    </div>
</form>