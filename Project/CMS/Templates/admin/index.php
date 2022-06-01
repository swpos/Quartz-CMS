<!DOCTYPE HTML>
<html>
	<head>
        <meta charset="UTF-8">
        <meta name="identifier-url" content="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
        <title><?php echo $al_site_title; ?> - Administrator</title>
		<link rel='stylesheet' type='text/css' href='../Templates/<?php echo $al_title_template; ?>/bootstrap/custom/bootstrap.min.css' />
		<script type="text/javascript" src="../Templates/<?php echo $al_title_template; ?>/js/jquery.js"></script>
		<?php echo eval( '?> '.$head.' <?php ' ); ?>
        <script type="text/javascript" src="../Templates/<?php echo $al_title_template; ?>/bootstrap/js/bootstrap.min.js"></script>
		<link rel='stylesheet' type='text/css' href='../Templates/<?php echo $al_title_template; ?>/style/basic.css' />
        <link rel='stylesheet' type='text/css' href='../Templates/<?php echo $al_title_template; ?>/style/screen.css' />
    </head>
    <body>
        <div class="container-fluid">
			<?php echo $al_info_admin ?>
        </div>
        <?php if ($al_title_page != 'Media') { ?>
            <script type="text/javascript" src="../Templates/<?php echo $al_title_template; ?>/js/main.js"></script>
            <?php
        }
        $_SESSION['error_message'] = '';
        ?>
		<?php echo eval( '?> '.$body.' <?php ' ); ?>
    </body>
</html>