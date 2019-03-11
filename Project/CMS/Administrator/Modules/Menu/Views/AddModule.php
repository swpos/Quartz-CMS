<?php echo $top_menu; ?>
<h1><?php echo ADD_MENU_MODULE ?></h1>
<?php echo $error; ?>	
<form action="index.php?page=Menu&action=_add_module_update" method="post" id="validator" role="form">
    <div class="row">
 	   <div class="col-md-6">
	       <table class="table-info table-striped">
				<?php foreach($form['modules'] as $rows => $data){ ?>
                    <?php if ($rows != 'modules'){ ?>
                        <tr>
                            <td width="20%"><?php echo $form['modules'][$rows]['label']; ?></td>
                            <td><?php echo $form['modules'][$rows]['control']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
            <table class="table-info table-striped">
				<?php foreach($section['sectionname'] as $rows => $data){ ?>
                    <tr>
                        <td width="20%"><?php echo $section['sectionname'][$rows]['label']; ?></td>
                        <td><?php echo $section['sectionname'][$rows]['control']; ?></td>
                    </tr>
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
            </table>
        </div>
    </div>
    <div class="row">
 		<div class="col-md-12">
    		<input type="submit" name="post" value="<?php echo BUTTON_ADD ?>" />
    	</div>
    </div>
</form>