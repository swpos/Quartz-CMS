<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="robots" content="index,follow" />
		<meta name="author" content="Template Builder" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Template</title>
        <link rel="stylesheet" type="text/css" class="bootstrap" href="bootstrap/css/bootstrap.min.css" />
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
		<link rel="stylesheet" type="text/css" href="style/custom.css" />
		<link rel="stylesheet" type="text/css" href="style/style.css" />
        <link rel="stylesheet" type="text/css" href="{theme_css}" class="theme_css" />
        <!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
        <script type="text/javascript">
			var loadScripts = function() {
				$('.star').on('click', function () {
				  $(this).toggleClass('star-checked');
				});
			
				$('.ckbox label').on('click', function () {
				  $(this).parents('tr').toggleClass('selected');
				});
			
				$('.btn-filter').on('click', function () {
				  var $target = $(this).data('target');
				  if ($target != 'all') {
					$('.table tr').css('display', 'none');
					$('.table tr[data-status="' + $target + '"]').fadeIn('slow');
				  } else {
					$('.table tr').css('display', 'none').fadeIn('slow');
				  }
				});
			}
			$(document).ready(function () {
				loadScripts();
			});
        </script>
	</head>
	<body>
        <div id="page">
            <div class="theme_content"></div>
        </div>
    </body>
</html>