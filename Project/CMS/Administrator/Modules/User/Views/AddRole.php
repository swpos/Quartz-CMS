<?php echo $top_menu; ?>
<h1><?php echo ADD_ROLE ?></h1>
<?php echo $error; ?>
<form action="index.php?page=User&action=role_edit_update" method="post" id="validator" role="form">
    <div class="row">
        <div class="col-md-12">
        	<table class="table-info table-striped">
                <tr>
                    <td width="20%"><?php echo $form['roles']['role']['label']; ?></td>
                    <td><input type='text' name='user[role]' value='' required pattern="([A-Za-z, :,0-9]){3,}" /></td>
                </tr>
				<?php foreach($form['roles'] as $rows => $data){ ?>
                    <?php if ($rows != 'role' && $rows != 'notes'){ ?>
                        <tr>
                            <td width="20%"><?php echo $form['roles'][$rows]['label']; ?></td>
                            <td><?php echo $form['roles'][$rows]['control']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                <tr>
                    <td colspan="2"><?php echo $form['roles']['notes']['control']; ?></td>
                </tr>
            </table>
            <input type='submit' value='<?php echo BUTTON_ADD ?>' />
        </div>
    </div>
</form>