<?php echo $top_menu; ?>
<h1><?php echo CONTROL_PANEL ?></h1>
<?php echo $error; ?>
<div class='cpanel'>
	<div class="row">
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-primary">
						<div class="panel-heading"><h2 class="panel-title" align="center"><?php echo CONTROL_PANEL_MODULES ?></h2></div>
						<div class="panel-body">
							<p align="center"><a href='index.php?page=Module&action=module'><img src='Media/Images/module.png' /></a></p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-primary">
						<div class="panel-heading"><h2 class="panel-title" align="center"><?php echo CONTROL_PANEL_ARTICLES ?></h2></div>
						<div class="panel-body">
							<p align="center"><a href='index.php?page=Article&action=article_listed_article'><img src='Media/Images/article.png' /></a></p>
						</div>	
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-primary">
						<div class="panel-heading"><h2 class="panel-title" align="center"><?php echo CONTROL_PANEL_USERS ?></h2></div>
						<div class="panel-body">
							<p align="center"><a href='index.php?page=User&action=user_listed'><img src='Media/Images/user.png' /></a></p>
						</div>	
					</div>
				</div>				
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-primary">
						<div class="panel-heading"><h2 class="panel-title" align="center"><?php echo CONTROL_PANEL_MENUS ?></h2></div>
						<div class="panel-body">
							<p align="center"><a href='index.php?page=Menu&action=menu_listed'><img src='Media/Images/menu.png' /></a></p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-primary">
						<div class="panel-heading"><h2 class="panel-title" align="center"><?php echo CONTROL_PANEL_TEMPLATES ?></h2></div>
						<div class="panel-body">
							<p align="center"><a href='index.php?page=Template&action=template_listed'><img src='Media/Images/template.png' /></a></p>
						</div>	
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-primary">
						<div class="panel-heading"><h2 class="panel-title" align="center"><?php echo CONTROL_PANEL_CONFIGURATION ?></h2></div>
						<div class="panel-body">
							<p align="center"><a href='index.php?page=Config&action=configuration_listed'><img src='Media/Images/config.png' /></a></p>
						</div>	
					</div>
				</div>				
			</div>
			
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-primary">
						<div class="panel-heading"><h2 class="panel-title" align="center"><?php echo CONTROL_PANEL_PLUGINS ?></h2></div>
						<div class="panel-body">
							<p align="center"><a href='index.php?page=Plugin&action=plugin_listed'><img src='Media/Images/plugin.png' /></a></p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-primary">
						<div class="panel-heading"><h2 class="panel-title" align="center"><?php echo CONTROL_PANEL_MEDIAS ?></h2></div>
						<div class="panel-body">
							<p align="center"><a href='index.php?page=Media&action=media'><img src='Media/Images/media.png' /></a></p>
						</div>	
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-primary">
						<div class="panel-heading"><h2 class="panel-title" align="center"><?php echo CONTROL_PANE_LOGOUT ?></h2></div>
						<div class="panel-body">
							<p align="center"><a href='index.php?page=Login&action=login_disconnect'><img src='Media/Images/logout.png' /></a></p>
						</div>	
					</div>
				</div>				
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-primary">
				<div class="panel-heading"><h2 class="panel-title" align="center"><?php echo CONTROL_PANEL_CONFIGURATION ?></h2></div>
				<div class="panel-body">
					<p align="center"><a href='index.php?page=Panel&action=clear_cache'>Clear Administrator Cache</a></p>
				</div>
			</div>
		</div>
	</div>
    <p class='footer'><?php echo CONTROL_PANEL_CREDIT ?></p>
</div>
