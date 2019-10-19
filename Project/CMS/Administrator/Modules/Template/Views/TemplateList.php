<?php echo $top_menu; ?>
<h1><?php echo LIST_TEMPLATE ?></h1>
<?php echo $error; ?>
<form action='index.php?page=Template&action=template_listed_update' method='post' />
<div class="row">
    <div class="col-md-12">
        <table class="table-info list table-striped">
        	<thead>
                <tr>
                    <th><?php echo LIST_TEMPLATE_PREVIEW ?></th>
                    <th><?php echo LIST_TEMPLATE_NAME ?></th>
                    <th><?php echo LIST_TEMPLATE_DESCRIPTION ?></th>
                    <th><?php echo LIST_TEMPLATE_DATE ?></th>
                    <th><?php echo LIST_TEMPLATE_TIME ?></th>
                    <th><?php echo LIST_TEMPLATE_ACTIVE ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><?php echo LIST_TEMPLATE_PREVIEW ?></th>
                    <th><?php echo LIST_TEMPLATE_NAME ?></th>
                    <th><?php echo LIST_TEMPLATE_DESCRIPTION ?></th>
                    <th><?php echo LIST_TEMPLATE_DATE ?></th>
                    <th><?php echo LIST_TEMPLATE_TIME ?></th>
                    <th><?php echo LIST_TEMPLATE_ACTIVE ?></th>
                </tr>
            </tfoot>
            <tbody>
				<?php
                foreach ($al_get_folders as $al_key => $al_value) {
                    if (($al_value != '..') && ($al_value != '.') && ($al_value != 'admin')) {
                        $al_fetch_template = $system_template->get_template_info($al_value);
                        ?>		
                        <tr>
                            <td width='150'>
                            	<a href="index.php?page=Template&action=template_edit&alias=<?php echo $al_value; ?>&file=&folder=../Templates/<?php echo $al_value; ?>"><img src='../Templates/<?php echo $al_value ?>/preview.jpg' style='width:100%; height:auto;' /></a>
                            </td>
                            <td>
                            	<h4>
                                <?php if($al_fetch_template->active == '1') { ?>
                                	<?php echo $al_value ?> 
                                    <label class="label label-success">                               		
                                		<a href="index.php?page=Template&action=template_edit&alias=<?php echo $al_value; ?>&file=&folder=../Templates/<?php echo $al_value; ?>" style="color: #ffffff"><?php echo EDIT_TEMPLATE ?></a>
                                    </label>
                                <?php } else { ?>
                                	<?php echo $al_value ?>
                                    <label class="label label-warning">
                                		 <a href="index.php?page=Template&action=template_edit&alias=<?php echo $al_value; ?>&file=&folder=../Templates/<?php echo $al_value; ?>" style="color: #ffffff"><?php echo EDIT_TEMPLATE ?></a>
                                    </label>
                                <?php } ?>
                                </h4>
                            </td>
                            <td>
                                <textarea name='description[<?php echo $al_fetch_template->id; ?>]'><?php echo $al_fetch_template->description ?></textarea>
                            </td>
                            <td>
                                <?php echo $al_fetch_template->date; ?>
                            </td>
                            <td>
                                <?php echo $al_fetch_template->time; ?>
                            </td>
                            <td>
                                <?php
                                    if($al_fetch_template->active == '1'){
                                        echo "Default";
                                    }
                                ?>
                                <input type='radio' name='active' value='<?php echo $al_fetch_template->id; ?>' />
                            </td>
                        </tr>	
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <input type='submit' value='<?php echo BUTTON_UPDATE ?>' />
    </div>
</div>
</form>
