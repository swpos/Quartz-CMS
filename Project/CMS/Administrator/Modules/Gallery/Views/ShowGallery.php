<?php echo $top_menu; ?>
<h1><?php echo SHOW_GALLERY ?></h1>
<?php echo $error; ?>
<div class="row">
    <div class="col-md-6">
        <table class='table-info table-striped'>
            <tr>
                <td width="15%">
                    <?php echo SHOW_GALLERY_TITLE ?>
                </td>
                <td>
                    <?php echo $al_fetch_gallery->title ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo SHOW_GALLERY_DATE ?>
                </td>
                <td>
                    <?php echo $al_fetch_gallery->date ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo SHOW_GALLERY_TIME ?>
                </td>
                <td>
                    <?php echo $al_fetch_gallery->time ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo SHOW_GALLERY_SHORTCUT ?>
                </td>
                <td>
                    <?php
                    $al_shortcut = str_replace(':', ', ', $al_fetch_gallery->shortcut);
                    echo $al_shortcut
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo SHOW_GALLERY_POSITION ?>
                </td>
                <td>
                    <?php echo $al_fetch_gallery->position ?>
                </td>
            </tr>

            <tr>
                <td>
                    <?php echo SHOW_GALLERY_ID ?>
                </td>
                <td>
                    <?php echo $al_fetch_gallery->id ?>
                </td>
            </tr>
        </table>
    </div> 
	<div class="col-md-6">
        <div class="well">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <?php foreach ($images as $image) { ?>
                            <div class="col-md-3">
                                <p><?php echo $image; ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>