<?php echo $top_menu; ?>
<h1><?php echo ADD_A_PLUGIN ?></h1>
<?php echo $error; ?>
<div class="row">
    <div class="col-md-12">
        <p><?php echo ADD_A_PLUGIN_INTRO ?></p>
        <form action="index.php?page=Plugin&action=plugin_upload" method="post" enctype="multipart/form-data">
            <input type="file" name="upload" id="file">
            <input type="submit" name="post" value="<?php echo BUTTON_UPLOAD ?>" />
        </form>
    </div>
</div>