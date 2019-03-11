<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<div class="list">
    <a href="index.php?page=addmodule&action=article">Add module article</a><br />
    <a href="index.php?page=addmodule&action=menu">Add module menu</a><br />
    <?php
        $select1=$al_connexion->query("SELECT * FROM ".HASH."_plugins WHERE publish='1'");
        $select1->setFetchMode(PDO::FETCH_OBJ);
        while($al_fetch_plugins = $select1->fetch()){
            $plugin_name=$al_fetch_plugins->content;
            $plugin_title=$al_fetch_plugins->title;
            include("modules/".$plugin_name."/links.php");
    ?>
    		<a href="<?php echo $al_add_module_link ?>">Add module <?php echo $plugin_title ?></a><br />
	<?php 
		} 
	?>
</div>