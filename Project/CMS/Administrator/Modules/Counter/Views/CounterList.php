<?php echo $top_menu; ?>
<h1><?php echo LIST_COUNTER ?></h1>
<?php echo $error; ?>
<div class='row'>
    <div class='col-md-12'>
        <p><?php echo LIST_COUNTER_INTRO ?></p>
        <table class='table-info list table-striped'>
            <thead>
                <tr>
                    <th><?php echo LIST_MAIN_TITLE ?></th>
                    <th><?php echo LIST_MAIN_DATE ?></th>
                    <th><?php echo LIST_MAIN_TIME ?></th>
                    <th><?php echo LIST_MAIN_SHORTCUT ?></th>
                    <th><?php echo LIST_MAIN_ID ?></th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th><?php echo LIST_MAIN_TITLE ?></th>
                    <th><?php echo LIST_MAIN_DATE ?></th>
                    <th><?php echo LIST_MAIN_TIME ?></th>
                    <th><?php echo LIST_MAIN_SHORTCUT ?></th>
                    <th><?php echo LIST_MAIN_ID ?></th>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($v->d_a($al_fetch_modules) as $al_fetch_module) { ?>
                    <tr>
                        <td>
                            <?php echo $al_fetch_module->title; ?>
                        </td>
                        <td>
                            <?php echo $al_fetch_module->date; ?>
                        </td>
                        <td>
                            <?php echo $al_fetch_module->time; ?>
                        </td>
                        <td>
                            <?php
                            $al_shortcut = str_replace(':', ' ', $al_fetch_module->shortcut);
                            echo $al_shortcut;
                            ?>
                        </td>
                        <td>
                            <?php echo $al_fetch_module->id; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <p>
			<?php echo LIST_COUNTER_NUMBER_OF_VISIT ?><br />
            <?php echo LIST_COUNTER_TODAY ?> : <?php echo $al_y1 ?><br />
            <?php echo LIST_COUNTER_TOTAL ?> : <?php echo $al_file_content1 ?>
        </p>
    </div>
</div>