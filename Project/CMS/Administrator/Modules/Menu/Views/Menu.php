<?php echo $top_menu; ?>
<h1><?php echo EDIT_MENU_MODULE ?></h1>
<?php echo $error; ?>
<form action="index.php?page=Menu&action=_edit_module_update&id=<?php echo $id ?>" method="post" id="validator" role="form">
    <div class="row">
 	   <div class="col-md-6">
	       <table class="table-info table-striped">
				<?php foreach($form['modules'] as $rows => $data){ ?>
                    <?php if ($rows != 'modules' && $rows != 'content'){ ?>
                        <tr>
                            <td width="20%"><?php echo $form['modules'][$rows]['label']; ?></td>
                            <td><?php echo $form['modules'][$rows]['control']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
       	</div>
        <div class="col-md-6">
            <table class="table-info table-striped">
                <?php foreach($form['modules']['modules'] as $key => $value){ ?>
                    <tr>
                        <td width="20%"><?php echo $form['modules']['modules'][$key]['label']; ?></td><td></td>
                    </tr>
                      
                    <?php for($i = 0; $i < count($form['modules']['modules'][$key]['control']); $i++){ ?>
                        <tr>
                            <td width="20%"><?php echo $form['modules']['modules'][$key]['control'][$i]['label']; ?></td>
                            <td><?php echo $form['modules']['modules'][$key]['control'][$i]['control']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                <tr>
                    <td>
                        <?php echo PAGE_OF_THE_MENU ?>
                    </td>
                    <td>
                        <ul>
                            <li><a href='index.php?page=Menu&action=menu_edit_section&id=<?php echo $id ?>&id_section=<?php echo $al_fetch_section_name->id ?>&id_module=<?php echo $id ?>'><?php echo $al_fetch_section_name->section ?></a>
                                <ul>							
                                    <?php foreach ($v->d_a($al_fetch_link_menu) as $al_fetch_link_menu) { ?>
                                        <li><a href='index.php?page=Menu&action=menu_listed_menu_link&id=<?php echo $id ?>&id_link=<?php echo $al_fetch_link_menu->id ?>'><?php echo $al_fetch_link_menu->name ?></a> <a href='index.php?page=Menu&action=menu_delete_link&id_link=<?php echo $al_fetch_link_menu->id ?>'><span class="icon glyphicon glyphicon-remove"></span></a> # <input type='text' style="width:20%; display:inline-block;" name='order[<?php echo $al_fetch_link_menu->id ?>]' value='<?php echo $al_fetch_link_menu->order1 ?>' /></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
       		<input type="submit" name="post" value="<?php echo BUTTON_MODIFY ?>" />
        </div>
    </div>                
</form>