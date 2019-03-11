<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="identifier-url" content="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
		<title><?php echo $al_site_title; ?> - Administrator</title>
        <link rel="stylesheet" type="text/css" href="../templates/<?php echo $al_title_template; ?>/bootstrap/custom/bootstrap.min.css" />
		<script type="text/javascript" src="../templates/<?php echo $al_title_template; ?>/js/jquery.js"></script>
        <script type="text/javascript" src="../templates/<?php echo $al_title_template; ?>/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../templates/<?php echo $al_title_template; ?>/widgets/chosen/chosen.jquery.js"></script>
		<link rel="stylesheet" href="../templates/<?php echo $al_title_template; ?>/widgets/chosen/chosen.css">
		<link rel="stylesheet" type="text/css" href="../templates/<?php echo $al_title_template; ?>/style/basic.css" />
        <?php if ($al_title_page != 'media') { ?>
			<script type="text/javascript">
                $(document).ready(function () {
                    $('.chosen-select').chosen({width: '100%', allow_single_deselect: true });
                });
            </script>
		<?php } ?>
		<?php include "editor.php"; ?>
	</head>
	<body>
		<div class="container-fluid">
			<?php echo $al_info_admin ?>
        </div>
		<?php include "editor_footer.php"; ?>
		<?php if($al_title_page != 'media'){ ?>
			<script type="text/javascript" src="../templates/<?php echo $al_title_template; ?>/js/main.js"></script>
		<?php } ?>
	</body>
</html>