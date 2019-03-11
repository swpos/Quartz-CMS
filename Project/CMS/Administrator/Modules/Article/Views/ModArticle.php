<?php echo $top_menu; ?>
<h1><?php echo MODIF_ARTICLE ?></h1>
<?php echo $error; ?>
<form action="index.php?page=Article&action=article_edit_article_update&id_article=<?php echo $id; ?>" method="post">
    <div class="row-fluid">
 	   <div class="col-md-6">
	       <table class="table-info table-striped">
				<?php foreach($form['articles'] as $rows => $data){ ?>
                    <?php if ($rows != 'modules' && $rows != 'content'){ ?>
                        <tr>
                            <td width="20%"><?php echo $form['articles'][$rows]['label']; ?></td>
                            <td><?php echo $form['articles'][$rows]['control']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
       	</div>
        <div class="col-md-6">
            <table class="table-info table-striped">
                <?php foreach($form['articles']['modules'] as $key => $value){ ?>
                    <tr>
                        <td width="20%"><?php echo $form['articles']['modules'][$key]['label']; ?></td><td></td>
                    </tr>
                      
                    <?php for($i = 0; $i < count($form['articles']['modules'][$key]['control']); $i++){ ?>
                        <tr>
                            <td width="20%"><?php echo $form['articles']['modules'][$key]['control'][$i]['label']; ?></td>
                            <td><?php echo $form['articles']['modules'][$key]['control'][$i]['control']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
            <table class="table-info table-striped">
                <tr>
                    <td><?php echo $form['articles']['content']['control']; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row-fluid">
	    <div class="col-md-12">
    		<input type="submit" value="<?php echo BUTTON_MODIFY ?>" />
    	</div>
    </div>
</form>