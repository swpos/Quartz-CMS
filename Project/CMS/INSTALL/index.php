<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="index,follow" />
		<title>Installation of the Quartz CMS - Version 3.x</title>
		<script type='text/javascript' src='js/jquery-1.11.1.min.js'></script>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
		<script type='text/javascript' src='bootstrap/js/bootstrap.min.js'></script>
		<link rel="stylesheet" type="text/css" href="style/style.css" />
		<script type="text/javascript">
			$(document).ready(function() {
				$( "form" ).each(function() {
					if($( this ).length > 0){
						$( this ).on('submit', function(e) {
							e.preventDefault();
							var errors = ''; 
							var $this = $(this);
							
					 		$this.find('input').each(function() {
								var field_label = $(this).parent().find('label').text();
								
								if($(this).val() == ''){
									errors += "The field " + field_label + " is missing informations <br />";
								}
							});
												 
							if(errors != '') {
								$('.well.messages').css('display','block');
								$('.well.messages p').removeClass('text-success');
								$('.well.messages p').addClass('text-danger');
								$('.well.messages p.infos').html(errors);
							} else {
								$('.well.messages').css('display','block');
																
								$.ajax({
									url: $this.attr('action'),
									type: $this.attr('method'),
									data: $this.serialize(),
									dataType: 'json',
									success: function(json) {
										$('.well.messages p').removeClass('text-danger');
										$('.well.messages p').addClass('text-warning');
										$('.well.messages p.infos').html(json.reponse);
										
										if(json.status == 'good') {
											var currentClass = $this.closest('.step').attr('data-class');
											$('ul.nav.navbar-nav li a.' + currentClass).css('color', '#0C0').addClass('complete');;
											$('.step').css('display', 'none');
											$this.closest('.step').next().css('display', 'block');
										}									
									}
								});
							}
						});
					}
				});
				$('.well.messages').css('display','none');
				$('.step').css('display','none');
				$('.step-1').css('display','block');
				
				$('.step-2-btn').click(function() {
					$('.step').css('display','none');
					$('.step-2').css('display','block');
					$('ul.nav.navbar-nav li a.step-1-item').css('color', '#0C0');
					$('ul.nav.navbar-nav li a.step-1-item').addClass('complete');
				});
				
				
				$('a.step-1-item').click(function() {
					if($('ul.nav.navbar-nav li a.step-1-item').hasClass("complete")){
						$('.step').css('display','none');
						$('.step-1').css('display','block');
					}
				});	
				
				$('a.step-2-item').click(function() {
					if($('ul.nav.navbar-nav li a.step-2-item').hasClass("complete")){
						$('.step').css('display','none');
						$('.step-2').css('display','block');
					}
				});	
				
				$('a.step-3-item').click(function() {
					if($('ul.nav.navbar-nav li a.step-3-item').hasClass("complete")){
						$('.step').css('display','none');
						$('.step-3').css('display','block');
					}
				});	
				
				$('a.step-4-item').click(function() {
					if($('ul.nav.navbar-nav li a.step-4-item').hasClass("complete")){
						$('.step').css('display','none');
						$('.step-4').css('display','block');
					}
				});
			});
		</script>
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12 intro">
					<nav class="navbar navbar-default">
						<div class="container-fluid">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand index" href="#">Quartz CMS</a>
							</div>
					
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav">
									<li><a href="#" class="step-1-item">Step 1</a></li>
									<li><a href="#" class="step-2-item">Step 2</a></li>
									<li><a href="#" class="step-3-item">Step 3</a></li>
									<li><a href="#" class="step-4-item">Install data</a></li>
								</ul>
							</div><!-- /.navbar-collapse -->
						</div><!-- /.container-fluid -->
					</nav>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div class="messages well">
								<p class="infos">&nbsp;</p>
							</div>
						</div>
					</div>	
					<div class="step-1 step" data-class="step-1-item">
						<div class="row">
							<div class="col-md-3">
								<h2>Version 3.x</h2>
								<img src="css/logo.jpg" width="100%" height="auto" />
							</div>
							<div class="col-md-9">
								<h2>Installation</h2>
								<p>Welcome to the installation of Quartz. To begin the installation click the button start.</p>
								<p><small><span class="text-danger">* Please do not clear the history during this Setup<br /> Make sure that the site root folder have write permission.</span></small></p>
								<p><a href="#" class="step-2-btn btn btn-success">Start</a></p>
							</div>
						</div>
					</div>
					<div class="step-2 step" data-class="step-2-item">
						<div class="row">
							<div class="col-md-3">
								<h2>Version 3.x</h2>
								<img src="css/logo.jpg" width="100%" height="auto" />
							</div>
							<div class="col-md-9">
								<h2>Step 2</h2>
								<form action="includes/step1.php" method="post">
									<div class="form-group">
										<label for="site_title">Choose a title for the site</label>
										<input type="text" size="30" name="site_title" class="form-control" value="" />
									</div>
									<div class="form-group">
										<label for="site_username">Choose a Username (admin)</label>
										<input type="text" size="30" name="site_username" class="form-control" value="" />
									</div>
									<div class="form-group">
										<label for="site_password">Choose a Password (admin)</label>
										<input type="password" size="30" name="site_password" class="form-control" value="" />
									</div>
									<div class="form-group">
										<label for="site_password">Confirm Password (admin)</label>
										<input type="password" size="30" name="site_password2" class="form-control" value="" />
									</div>
									<div class="form-group">
										<label for="site_email">Choose an Email (admin)</label>
										<input type="text" size="30" name="site_email" class="form-control" value="" />
									</div>
									<div class="form-group">
										<label for="site_email2">Confirm Email (admin)</label>
										<input type="text" size="30" name="site_email2" class="form-control" value="" />
									</div>
									<button type="submit" class="btn btn-default">Next step</button>
								</form>
							</div>
						</div>
					</div>
					<div class="step-3 step" data-class="step-3-item">
						<div class="row">
							<div class="col-md-3">
								<h2>Version 3.x</h2>
								<img src="css/logo.jpg" width="100%" height="auto" />
							</div>
							<div class="col-md-9">
								<h2>Step 3</h2>
								<form action="includes/step2.php" method="post">
									<div class="form-group">
										<label for="database_host">The Mysql host</label>
										<input type="text" size="30" name="database_host" class="form-control" value="" />
									</div>
									<div class="form-group">
										<label for="database_name">The database</label>
										<input type="text" size="30" name="database_name" class="form-control" value="" />
									</div>
									<div class="form-group">
										<label for="database_user">The database User</label>
										<input type="text" size="30" name="database_user" class="form-control" value="" />
									</div>
									<div class="form-group">
										<label for="database_password">The database password</label>
										<input type="password" size="30" name="database_password" class="form-control" value="" />
									</div>
									<div class="form-group">
										<label for="prefix_table">Hash protection table (prefix) 
										<br />(between 2 and 7 caracters inclusively)</label>
										<input type="text" size="30" name="prefix_table" value="" class="form-control" placeholder="cms" />
									</div>
									<button type="submit" class="btn btn-default">Next step</button>
								</form>
							</div>
						</div>
					</div>
					<div class="step-4 step" data-class="step-4-item">
						<div class="row">
							<div class="col-md-3">
								<h2>Version 3.x</h2>
								<img src="css/logo.jpg" width="100%" height="auto" />
							</div>
							<div class="col-md-9">
								<h2>Install data</h2>
								<form action="includes/step3.php" method="post">
									<button type="submit" class="btn btn-success">Install Data</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>