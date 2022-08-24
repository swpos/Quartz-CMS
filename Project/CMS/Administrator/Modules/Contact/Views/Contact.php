<?php echo $top_menu; ?>
<h1><?php echo EDIT_CONTACT_MODULE ?></h1>
<?php echo $error; ?>
<form action="index.php?page=Contact&action=_edit_module_update&id=<?php echo $id; ?>" method="post" id="validator" role="form">
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
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
       		<input type="submit" name="post" value="<?php echo BUTTON_MODIFY ?>" />
        </div>
    </div>
</form>
