<div class="row">
	<div class="col-md-12">
    	<?php if($title){ ?>
            <h2>
                <?php echo $al_fetch_module->title; ?>
            </h2>       
        <?php } ?>
        <p align="center">
        	<small>
            	<?php echo COUNTER_MODULE_NUMBER_VISIT ?>;
            	<?php echo COUNTER_MODULE_TODAY ?> : <?php echo $al_y1 ?>,
            	<?php echo COUNTER_MODULE_IN_TOTAL ?> : <?php echo $al_file_content1 ?>
            </small>
        </p>
    </div>
</div>