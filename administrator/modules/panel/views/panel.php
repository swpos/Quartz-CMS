<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>CONTROL PANEL</h1>
<div class="cpanel">
    <ul>
        <li class="nav first"><a href="index.php"><img src="media/images/module.png" /></a><br />Modules</li>
        <li class="nav"><a href="index.php?page=list_article"><img src="media/images/article.png" /></a><br />Articles</li>
        <li class="nav"><a href="index.php?page=list_user"><img src="media/images/user.png" /></a><br />Users</li>
        <li class="nav"><a href="index.php?page=menu_list"><img src="media/images/menu.png" /></a><br />Menus</li>
        <li class="nav"><a href="index.php?page=list_template"><img src="media/images/template.png" /></a><br />Templates</li>
        <li class="nav"><a href="index.php?page=configuration"><img src="media/images/config.png" /></a><br />Configuration</li>
        <li class="nav"><a href="index.php?page=plugins"><img src="media/images/plugin.png" /></a><br />Plugins</li>
        <li class="nav"><a href="index.php?page=media"><img src="media/images/media.png" /></a><br />Medias</li>	
        <li class="nav"><a href="index.php?page=disconnect"><img src="media/images/logout.png" /></a><br />Logout</li>
    </ul>
    <p class="footer">Version 1.0 Beta - CMS Quartz</p>
</div>