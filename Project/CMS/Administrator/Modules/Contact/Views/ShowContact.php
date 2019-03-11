<?php echo $top_menu; ?>
<h1><?php echo SHOW_CONTACT ?></h1>
<?php echo $error; ?>
<form action="index.php?page=Contact&action=update_show_contact&id=<?php echo $id; ?>" method="post" id="validator" role="form">
    <div class="row">
 	   <div class="col-md-6">
	       <table class="table-info table-striped">
				<?php foreach($form['contact'] as $rows => $data){ ?>
                    <?php if ($rows != 'content'){ ?>
                        <tr>
                            <td width="20%"><?php echo $form['contact'][$rows]['label']; ?></td>
                            <td><?php echo $form['contact'][$rows]['control']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
       	</div>
        <div class="col-md-6">
            <table class="table-info table-striped">
                <tr>
                    <td><?php echo $form['contact']['content']['control']; ?></td>
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