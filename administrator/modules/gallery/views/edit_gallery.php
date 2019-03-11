<?php 
	$al_id=decoding($al_fetch_gallery->id);
	$al_title=decoding($al_fetch_gallery->title);
	$al_date=decoding($al_fetch_gallery->date);
	$al_time=decoding($al_fetch_gallery->time);
	$al_shortcut=decoding($al_fetch_gallery->shortcut);
	$al_shortcut=str_replace(':',', ',$al_shortcut);
	$al_position=decoding($al_fetch_gallery->position);
?>
<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>EDIT GALLERY</h1>
<table class="table-striped">
    <tr>
        <td width="20%">Title</td>
        <td><?php echo $al_title ?></td>
    </tr>
    <tr>
        <td width="20%">Date</td>
        <td><?php echo $al_date ?></td>
    </tr>
    <tr>
        <td width="20%">Time</td>
        <td><?php echo $al_time ?></td>
    </tr>
    <tr>
        <td width="20%">Shortcut</td>
        <td><?php echo $al_shortcut ?></td>
    </tr>
    <tr>
        <td width="20%">Position</td>
        <td><?php echo $al_position ?></td>
    </tr>
    <tr>
        <td width="20%">Gallery</td>
        <td>
			<?php 
                $al_dir    = '../media/gallery';
                $al_get_folders = scandir($al_dir);
                
                foreach($al_get_folders as $al_key => $al_value){
                    $get_id = explode('_',$al_value);
                    
                    if($get_id[0] == $al_id){
            ?>        
                    <img src="../media/gallery/<?php echo $al_value ?>" width="150" style="margin:5px; float:left;" height="auto" />
            <?php 
                    }
                }
            ?>
		</td>
	</tr>
	<tr>
        <td width="20%">Id</td>
        <td><?php echo $al_id ?></td>
	</tr>
</table>