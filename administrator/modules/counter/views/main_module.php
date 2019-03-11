<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>COUNTER</h1>
<p>The Counter modules installed</p>
<table class="table-striped list">
    <tr>
        <td>Title</td>
        <td>Date</td>
        <td>Time</td>
        <td>Shortcut</td>
        <td>Id</td>
    </tr>
 <?php   
    $select1=$al_connexion->query("SELECT * FROM ".HASH."_modules WHERE modules LIKE '%type_counter%'");
    $select1->setFetchMode(PDO::FETCH_OBJ);
    
    while($al_fetch_module = $select1->fetch()){	
        $al_id=decoding($al_fetch_module->id);
        $al_title=decoding($al_fetch_module->title);
        $al_date=decoding($al_fetch_module->date);
        $al_time=decoding($al_fetch_module->time);
        $al_shortcut=decoding($al_fetch_module->shortcut);
        $al_shortcut=str_replace(':',' ',$al_shortcut);
?>
        <tr>
            <td><?php echo $al_title ?></td>
            <td><?php echo $al_date ?></td>
            <td><?php echo $al_time ?></td>
            <td><?php echo $al_shortcut ?></td>
            <td><?php echo $al_id ?></td>
        </tr>
<?php
    }
    
    $al_time=date('Ymd');
    $al_filename_path = '../modules/counter/visit/counter.txt';
    $al_file_content1 = file_get_contents($al_filename_path);
    $al_filename_path2 = '../modules/counter/visit/counter2.txt';
    $al_file_open = fopen($al_filename_path2, "r");                     
    $al_contents2 = fread($al_file_open, filesize($al_filename_path2));         
    fclose($al_file_open);
    $al_y1=0;
    $al_explode2=explode(":", $al_contents2);
    $al_count2=count($al_explode2);
    for($al_i=0; $al_i<$al_count2; $al_i++){
        if($al_explode2[$al_i]==$al_time){
            $al_y1++;
        }
    }
?>	
</table>
<p>Number of visits</p>
<p>Today : <?php echo $al_y1 ?></p>
<p>At total : <?php echo $al_file_content1 ?></p>