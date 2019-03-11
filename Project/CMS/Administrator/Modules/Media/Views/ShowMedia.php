<?php echo $top_menu; ?>
<h1><?php echo SHOW_MEDIAS ?></h1>
<?php echo $error; ?>
<form action="index.php?page=Media&action=delete_media" method="post">
    <div class="row">
        <div class="col-md-12">
            <table class="table-info table-striped list">
                <thead>
                    <tr>
                        <th><?php echo SHOW_MEDIAS_PICTURE ?></th>
                        <th><?php echo SHOW_MEDIAS_FILE_NAME ?></th>
                        <th><?php echo SHOW_MEDIAS_FILE_SIZE ?></th>
                        <th><?php echo SHOW_MEDIAS_DELETE ?></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><?php echo SHOW_MEDIAS_PICTURE ?></th>
                        <th><?php echo SHOW_MEDIAS_FILE_NAME ?></th>
                        <th><?php echo SHOW_MEDIAS_FILE_SIZE ?></th>
                        <th><?php echo SHOW_MEDIAS_DELETE ?></th>
                    </tr>
                </tfoot>
                <?php
                foreach ($al_get_folders as $al_key => $al_value) {
                    if (($al_value != '..') && ($al_value != '.') && (!is_dir($al_value))) {
                        ?>
                        <tr>
                            <td><img src="<?php echo $al_dir ?>/<?php echo $al_value; ?>" /></td>
                            <td><?php echo $al_value; ?></td>
                            <td><?php echo filesize("../Media/" . $al_value); ?> <?php echo SHOW_MEDIAS_BYTES ?></td>
                            <td><input type="checkbox" name="images[]" value="<?php echo $al_value; ?>"></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <input type="submit" class="btn btn-primary" value="<?php echo BUTTON_DELETE ?>" />
        </div>
    </div>
</form>