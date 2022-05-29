<?php echo $top_menu; ?>
<h1><?php echo UPDATE_USER ?></h1>
<?php echo $error; ?>
<form action="index.php?page=User&action=user_edit_update" method="post">
    <div class="row">
        <div class="col-md-12">
        	<table class="table-info table-striped">
                <tr>
                    <td width="20%"><?php echo $form['users']['username']['label']; ?></td>
                    <td><input type='text' name='user[username]' value='<?php echo $al_fetch_users->username ?>' required pattern="([A-Za-z, :,0-9]){3,}" /></td>
                </tr>
                <tr>
                    <td><?php echo $form['users']['email']['label']; ?></td>
                    <td><input type='text' name='user[email]' value='<?php echo $al_fetch_users->email ?>' required pattern='^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$' /></td>
                </tr>
                <tr>
                    <td><?php echo $form['users']['age']['label']; ?></td>
                    <td><input type='text' name='user[age]' value='<?php echo $al_fetch_users->age ?>' required pattern="^([0-9]){1,}$" /></td>
                </tr>
                <tr>
                    <td><?php echo $form['users']['picture']['label']; ?></td>
                    <td><?php if(!empty($al_fetch_users->picture) && file_exists($al_fetch_users->picture)){ ?><p><img src="<?php echo $al_fetch_users->picture; ?>" width="200" height="auto" /></p><?php } else { echo '<p class="text-danger">'.NOT_A_VALID_PICTURE.'</p>'; } ?>                   
                    <div class="input-group image" id="image"><input type='text' name='user[picture]' value='<?php echo $al_fetch_users->picture ?>' id='<?php echo md5('user[picture]'); ?>' required /><span class="input-group-addon image-addon" onclick="return popup('index.php?page=Media&action=media_select&field_id=<?php echo md5('user[picture]'); ?>', 'Choose a Media', '1400', '600')"><span class="glyphicon glyphicon-picture"></span></span></div></td>
                </tr>
				<?php foreach($form['users'] as $rows => $data){ ?>
                    <?php if ($rows != 'username' && $rows != 'email' && $rows != 'age' && $rows != 'about' && $rows != 'picture'){ ?>
                        <tr>
                            <td width="20%"><?php echo $form['users'][$rows]['label']; ?></td>
                            <td><?php echo $form['users'][$rows]['control']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                <tr>
                    <td colspan="2"><?php echo $form['users']['about']['control']; ?></td>
                </tr>
            </table>
            <input type='submit' value='<?php echo BUTTON_MODIFY ?>' />
        </div>
    </div>
</form>
