<h1>Medias</h1>
<html>
    <head>
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <link rel='stylesheet' type='text/css' href='bootstrap/css/bootstrap.min.css' />
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        	$(document).ready(function (e) {
				$("#upload").on('submit', function(e) {
					e.preventDefault();
					$(".message").css('display', 'block');
					$(".message").html('Loading...');
					
					$.ajax({
						url: "uploadfile.php",
						type: "POST",
						data: new FormData(this),
						contentType: false,
						cache: false,
						processData:false,
						success: function(data) {
							$(".message").html(data);
						}
					});
				});
				
				$("#file").on('click', function(e) {
					$(".message").html('');
					$(".message").css('display', 'none');
				});
			});
        </script>
    </head>
    <body>
        <form id="upload" action="" method="post" enctype="multipart/form-data">
            <label>Select a file</label>
            <div class="input-group">
            	<input type="file" name="file" style="height: 100% !important; padding:5px !important;" id="file" class="form-control" aria-describedby="basic-addon2" required />
                <div class="input-group-addon" id="basic-addon2"><input type="submit" style="padding: 0px 5px !important;" value="Upload" class="submit btn btn-warning" /></div>
            </div>
            <br />
            <p class="alert alert-warning message" style="display:none;"></p>
        </form>
    </body>
</html>