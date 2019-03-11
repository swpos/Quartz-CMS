<?php echo $top_menu; ?>	
<h1><?php echo ADD_ARTICLE_ADD_ARTICLE ?></h1>
<?php echo $error; ?>
<form action="index.php?page=Article&action=article_add_article_update" method="post" id="validator" role="form">
    <div class="row">
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
    <div class="row">
	    <div class="col-md-12">
    		<input type="submit" value="<?php echo BUTTON_MODIFY ?>" />
    	</div>
    </div>
</form>