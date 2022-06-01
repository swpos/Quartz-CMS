<?php
	$url_website = $this->container->system_config->full_url();
	if($page == 'Media') {
?>
<script>
	/* global $, window */
	$(function () {
	  'use strict';

	  // Initialize the jQuery File Upload widget:
	  $('#fileupload').fileupload({
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true},
		url: '<?php echo $url_website ?>/Media/'
	  });

	  // Enable iframe cross-domain access via redirect option:
	  $('#fileupload').fileupload(
		'option',
		'redirect',
		window.location.href.replace(/\/[^/]*$/, '../Plugins/fileupload/files/cors/result.html?%s')
	  );

	  if (window.location.hostname === '<?php echo $_SERVER['SERVER_NAME'] ?>') {
		// Demo settings:
		$('#fileupload').fileupload('option', {
		  url: '<?php echo $url_website ?>/Plugins/fileupload/files/server/php/index.php',
		  // Enable image resizing, except for Android and Opera,
		  // which actually support image resizing, but fail to
		  // send Blob objects via XHR requests:
		  disableImageResize: /Android(?!.*Chrome)|Opera/.test(
			window.navigator.userAgent
		  ),
		  maxFileSize: 999000,
		  acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
		});
		// Upload server status check for browsers with CORS support:
		if ($.support.cors) {
		  $.ajax({
			url: '<?php echo $url_website ?>/Plugins/fileupload/files/server/php/index.php',
			type: 'HEAD'
		  }).fail(function () {
			$('<div class="alert alert-danger"></div>')
			  .text('Upload server currently unavailable - ' + new Date())
			  .appendTo('#fileupload');
		  });
		}
	  } else {
		// Load existing files:
		$('#fileupload').addClass('fileupload-processing');
		$.ajax({
		  // Uncomment the following to send cross-domain cookies:
		  //xhrFields: {withCredentials: true},
		  url: $('#fileupload').fileupload('option', 'url'),
		  dataType: 'json',
		  context: $('#fileupload')[0]
		})
		  .always(function () {
			$(this).removeClass('fileupload-processing');
		  })
		  .done(function (result) {
			$(this)
			  .fileupload('option', 'done')
			  // eslint-disable-next-line new-cap
			  .call(this, $.Event('done'), { result: result });
		  });
	  }
	});
</script>
<?php } ?>