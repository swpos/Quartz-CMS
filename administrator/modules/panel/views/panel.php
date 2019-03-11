<?php echo buildMenu($al_connexion); ?>
<?php echo $_SESSION['error_message']; ?>
<h1>CONTROL PANEL</h1>
<div class="cpanel">
    <div class="row">
    	<div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">
                	<h3 class="panel-title">Modules</h3>
                </div>
                <div class="panel-body" align="center">
                	<a href="index.php"><img src="media/images/module.png" /></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">
                	<h3 class="panel-title">Articles</h3>
                </div>
                <div class="panel-body" align="center">
                	<a href="index.php?page=list_article"><img src="media/images/article.png" /></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">
                	<h3 class="panel-title">Users</h3>
                </div>
                <div class="panel-body" align="center">
                	<a href="index.php?page=list_user"><img src="media/images/user.png" /></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">
                	<h3 class="panel-title">Menus</h3>
                </div>
                <div class="panel-body" align="center">
                	<a href="index.php?page=menu_list"><img src="media/images/menu.png" /></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">
                	<h3 class="panel-title">Templates</h3>
                </div>
                <div class="panel-body" align="center">
                	<a href="index.php?page=list_template"><img src="media/images/template.png" /></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">
                	<h3 class="panel-title">Configuration</h3>
                </div>
                <div class="panel-body" align="center">
                	<a href="index.php?page=configuration"><img src="media/images/config.png" /></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">
                	<h3 class="panel-title">Plugins</h3>
                </div>
                <div class="panel-body" align="center">
                	<a href="index.php?page=plugins"><img src="media/images/plugin.png" /></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">
                	<h3 class="panel-title">Medias</h3>
                </div>
                <div class="panel-body" align="center">
                	<a href="index.php?page=media"><img src="media/images/media.png" /></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">
                	<h3 class="panel-title">Logout</h3>
                </div>
                <div class="panel-body" align="center">
                	<a href="index.php?page=disconnect"><img src="media/images/logout.png" /></a>
                </div>
            </div>
        </div>
    </div>
    <p class="footer">Version 2.0 Beta - CMS Quartz</p>
</div>