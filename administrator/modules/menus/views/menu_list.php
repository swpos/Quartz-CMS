<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>MENU LIST</h1>
	<div class="row">
    <?php
		$select1=$al_connexion->query("SELECT * FROM ".HASH."_modules WHERE modules LIKE '%type_menu%'");
		$select1->setFetchMode(PDO::FETCH_OBJ);
		while($al_fetch_modules = $select1->fetch()){
			$al_id=$al_fetch_modules->id;
			$al_id_module=$al_fetch_modules->id;
			$al_title=$al_fetch_modules->title;
			if($al_title != "hidden"){
				$select2=$al_connexion->query("SELECT * FROM ".HASH."_section_name WHERE id_module='$al_id'");
				$select2->setFetchMode(PDO::FETCH_OBJ);
				while($al_fetch_section_name = $select2->fetch()){
					$al_section=decoding($al_fetch_section_name->section);
					$al_id_menu=decoding($al_fetch_section_name->id);
	 ?>
		<div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
        			<h3 style="padding: 0px; margin: 0px; text-align:center;"><a href="index.php?page=menu&action=section_link&id=<?php echo $al_id; ?>&id_section=<?php echo $al_id_menu; ?>&id_module=<?php echo $al_id_module; ?>"><?php echo $al_section; ?></a></h3>
            	</div>
                <div class="panel-body">	
     <?php 	
					$select3=$al_connexion->query("SELECT * FROM ".HASH."_link_menu WHERE id_index='".$al_id_menu."'");
					$select3->setFetchMode(PDO::FETCH_OBJ);			
					while($al_fetch_link_menu = $select3->fetch()){
						$al_name=decoding($al_fetch_link_menu->name);
						$al_shortcut_unique=decoding($al_fetch_link_menu->shortcut);
						$al_id_link=decoding($al_fetch_link_menu->id);
	?>
                        <p>
                            <a href="index.php?page=menu&action=link&id=<?php echo $al_id; ?>&id_link=<?php echo $al_id_link; ?>"><?php echo $al_name; ?></a> 
                            <a href="index.php?page=menu&action=delete_link&id_link=<?php echo $al_id_link; ?>"><span class="glyphicon glyphicon-remove"></span></a>
                        </p>
    <?php		
					}
	?>
            	</div>
            </div>
		</div>
	<?php
				}			
			}
		}
	?>
</div>