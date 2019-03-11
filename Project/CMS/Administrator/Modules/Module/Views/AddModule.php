<?php echo $top_menu; ?>
<h1><?php echo ADD_A_MODULE ?></h1>
<div class="row">
    <div class="col-md-12">
        <a href='index.php?page=Article&action=_add_module'><?php echo ADD_A_MODULE_ARTICLE ?></a><br />
        <a href='index.php?page=Menu&action=_add_module'><?php echo ADD_A_MODULE_MENU ?></a><br />
        <a href='index.php?page=Custom&action=_add_module'><?php echo ADD_A_MODULE_CUSTOM ?></a><br />
		<a href='index.php?page=Language&action=_add_module'><?php echo ADD_A_MODULE_LANGUAGE ?></a><br />
		<a href='index.php?page=User&action=_add_module'><?php echo ADD_A_MODULE_USER ?></a><br />
        <?php
        foreach ($v->d_a($al_fetch_plugin) as $al_fetch_plugin) {
			if(file_exists("Modules/" . ucfirst($al_fetch_plugin->content) . "/Links.php")){
				include("Modules/" . ucfirst($al_fetch_plugin->content) . "/Links.php");
				if(strlen($al_add_module_link) > 1){ ?>
					<a href='<?php echo $al_add_module_link ?>'><?php echo ADD_A_MODULE_ADD_MODULE ?> <?php echo $al_fetch_plugin->title ?></a><br />
			<?php 
				}
			}
		} ?>
    </div>
</div>