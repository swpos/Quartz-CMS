<!DOCTYPE html>
<html>
	<head>
    	<link rel="apple-touch-icon" sizes="180x180" href="/templates/<?php echo $al_title_template; ?>/style/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/templates/<?php echo $al_title_template; ?>/style/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/templates/<?php echo $al_title_template; ?>/style/favicon/favicon-16x16.png">
        <link rel="manifest" href="/templates/<?php echo $al_title_template; ?>/style/favicon/site.webmanifest">
        <link rel="mask-icon" href="/templates/<?php echo $al_title_template; ?>/style/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <?php 
			$site_title = $al_site_title;
			if($al_title_page && $al_title_page != 'index'){ $site_title .="- ".$al_title_page; }
			$meta_description = 'The version 1 of the Quartz content managing system.'; 
			$meta_keywords = 'version 1, content, managing, system, Quartz, CMS, demo'; 
			if($al_title_page){ $meta_keywords .=', '.$al_title_page; }
			$image_preview = '/templates/'.$al_title_template.'/style/favicon/android-chrome-384x384.png';
			$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"; 
			$link2 = $link . $_SERVER['REQUEST_URI'];
		?>
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
    	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="content-type" content="utf-8" />
        <meta name="content-language" content="en" />
        <meta name="revisit-after" content="7 days">
        <meta name="description" content="<?php echo $meta_description; ?>" />
        <meta name="keywords" content="<?php echo $meta_keywords; ?>" />
        <meta name="robots" content="index, follow" />
		<meta name="author" content="Alexandre Lefebvre" />
		<meta name="rev" content="alexandre.lefebvre7@.outlook.com" />
        <meta name="image" content="<?php echo $link.$image_preview; ?>">
        <meta itemprop="name" content="<?php echo $site_title; ?>">
        <meta itemprop="description" content="<?php echo $meta_description; ?>">
        <meta itemprop="image" content="<?php echo $link.$image_preview; ?>">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="<?php echo $site_title; ?>">
        <meta name="twitter:description" content="<?php echo $meta_description; ?>">
        <meta property="og:title" content="<?php echo $site_title; ?>">
        <meta property="og:description" content="<?php echo $meta_description; ?>">
        <meta property="og:image" content="<?php echo $link.$image_preview; ?>">
        <meta property="og:url" content="<?php echo $link2; ?>">
        <meta property="og:site_name" content="<?php echo $site_title; ?>">
        <meta property="og:locale" content="en_US">
        <meta property="fb:admins" content="438383526677378">
        <meta property="fb:app_id" content="298627057545804">
        <meta property="og:type" content="website">
		<title><?php echo $site_title; ?></title>
        <link rel="stylesheet" type="text/css" href="/templates/<?php echo $al_title_template; ?>/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/templates/<?php echo $al_title_template; ?>/style/style.css" />
		<script type="text/javascript" src="/templates/<?php echo $al_title_template; ?>/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="/templates/<?php echo $al_title_template; ?>/bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12 intro">
					<nav class="navbar navbar-inverse">
						<div class="container-fluid">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="/"><?php echo $al_site_title; ?></a>
							</div>
					
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<?php if(isset($menu)){ eval( '?> '.$menu.' <?php ' ); } ?>
							</div>
						</div>
					</nav>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php if(isset($article_home_page)){ eval( '?> '.$article_home_page.' <?php ' ); } ?>
					<?php if(isset($article)){ eval( '?> '.$article.' <?php ' ); } ?>
                    <?php if(isset($extra)){ eval( '?> '.$extra.' <?php ' ); } ?>
				</div>
			</div>
		</div>
		<script src="/templates/<?php echo $al_title_template; ?>/js/custom.js"></script>	
	</body>
</html>